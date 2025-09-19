@extends('layouts.master')

@section('css')
<style>
  html, body {
            margin: 0;
            padding: 0;
            height: 100dvh;
            width: 100dvw;
        }

        #app {
            display: flex;
            flex-direction: column;
            height: 100dvh;
            width: 100dvw;
        }

        nav {
            flex: 0 0 auto;
        }

        #map {
            flex: 1;
            height: 95dvh;
            width: 100dvw;
        }

        .btn-gestionar {
            background: linear-gradient(135deg, #2563eb, #3b82f6); /* Azul degradado */
            color: #fff;
            width: 100%;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.35rem 0.8rem;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.4);
            transition: all 0.2s ease-in-out;
        }

        .btn-gestionar:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.6);
            transform: translateY(-2px);
        }

        .btn-gestionar:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 16px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            flex: 1; /* Para que ocupen el mismo ancho en el offcanvas */
        }

        .btn-view {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
        }
        .btn-view:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.4);
        }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #fff;
        }
        .btn-edit:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
        }
        .btn-delete:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.4);
        }
        
</style>
@endsection

@section('body')
<div id="app">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container d-flex justify-content-between">
            <div class="d-flex align-items-center justify-content-center gap-2">
                <a class="navbar-brand fw-bold" href="#">Visit Route</a>
                <i class="fa-solid fa-route fs-1"></i>
            </div>
            
            <div class="s">
                <button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCreateVisit" aria-controls="offcanvasCreateVisit">
                    Agregar Visita
                </button>
            </div>
        </div>
    </nav>

    <div id="map"></div>
    @include('visit.offcanvas.create')
    @include('visit.offcanvas.manageVisit')
</div>
@endsection

@section('js')
<script>
    const { createApp, ref, reactive, onMounted, } = Vue

        createApp({
            setup() {
                const map = ref(null);
                const visits = ref([]);
                const visit = ref({
                    name: '',
                    email: '',
                    latitude: null,
                    longitude: null,
                })
                const isLoading = ref(false)
                const manageVisitMode = ref('view');


                onMounted(() => {
                    map.value = L.map("map").setView([4.711, -74.0721], 12);

                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map.value);

                    getAllVisits();
                });

                async function saveVisit() {
                    isLoading.value = true
                    try {
                        const response = await fetch('{{route('visits.store')}}', {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                            body: JSON.stringify(visit.value)
                        });

                        const data = await response.json()

                         if (!response.ok) {
                            if (data.errors) {
                                Object.values(data.errors).forEach(errorMsg => {
                                    Toastify({
                                        text: errorMsg,
                                        duration: 2000,
                                        gravity: "right",
                                        position: "right",
                                        style: {
                                            background: "#ef4444",
                                        },
                                        stopOnFocus: true,
                                    }).showToast();
                                });   
                            }
                            return;
                        }

                        Toastify({
                            text: data.message,
                            duration: 4000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "#10b981",
                            },
                            stopOnFocus: true,
                        }).showToast()
                        $('#offcanvasCreateVisit').offcanvas('hide');
                    } catch (err) {
                       console.error('Error al guardar visita: ', err)
                    } finally {
                        isLoading.value = false
                    }
                }

                async function getVisitsMap() {
                    try {
                        const response = await fetch('{{route('visits.index')}}');
                        const data = await response.json();
                        visits.value = data.data;

                        visits.value.forEach(v => {
                            const marker = L.marker([v.latitude, v.longitude]).addTo(map.value);
                            
                            const popupContent = document.createElement("div");
                            popupContent.innerHTML = `
                                <b>${v.name}</b><br>
                                ${v.email}<br>
                                <button class="btn-gestionar mt-2">Gestionar</button>
                            `;

                            popupContent.querySelector("button")?.addEventListener("click", () => {
                                manageVisit(v.id);
                            });

                            marker.bindPopup(popupContent);

                        });
                    } catch (err) {
                        console.error('Error al obtener visitas: ', err)
                    }
                }

                async function manageVisit(id) {                    
                    try {
                        let url = "{{ route('visits.show', ['id' => '?']) }}".replace('?', id);
                        const response = await fetch(url);
                        const data = await response.json();

                        if(!response.ok) {
                            if(data.message) {
                                Toastify({
                                    text: data.message,
                                    duration: 2000,
                                    gravity: "right",
                                    position: "right",
                                    style: {
                                        background: "#ef4444",
                                    },
                                    stopOnFocus: true,
                                }).showToast();
                            }
                            return;
                        }

                        visit.value = data.data;
                        $('#offcanvasManageVisit').offcanvas('show');
                    } catch (err) {
                        console.error('Error al obtener visitas: ', err)
                    }
                     
                }

                function showView() {
                    manageVisitMode.value = 'view';
                }
                function showEdit() {
                    manageVisitMode.value = 'edit';
                }

                return {
                    map,
                    visits,
                    visit,
                    isLoading,
                    saveVisit,
                    manageVisit,
                    manageVisitMode,
                    showView,
                    showEdit,
                }
            }
        }).mount('#app')
</script>
@endsection