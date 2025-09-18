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


                onMounted(() => {
                    map.value = L.map("map").setView([4.711, -74.0721], 12);

                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map.value);
                });

                const saveVisit = async () => {
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

                        if (!response.ok) {
                            throw new Error('Fallo en la petición')
                        }

                        const data = await response.json()

                        Toastify({
                            text: data.message,
                            duration: 4000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#10b981",
                            stopOnFocus: true,
                        }).showToast()
                        $('#offcanvasCreateVisit').offcanvas('hide');
                        
                    } catch (err) {
                       console.error('Error al guardar visita: ', err)
                    } finally {
                        isLoading.value = false
                    }
                }

                return {
                    map,
                    visits,
                    visit,
                    isLoading,
                    saveVisit,
                }
            }
        }).mount('#app')
</script>
@endsection