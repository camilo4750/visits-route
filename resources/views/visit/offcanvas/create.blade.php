<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateVisit" aria-labelledby="offcanvasCreateVisitLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasCreateVisitLabel">Agregar Visita</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form @submit.prevent="saveVisit">
      <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" placeholder="Nombre" v-model="newVisit.name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" placeholder="Correo electronico" v-model="newVisit.email">
      </div>
      <div class="mb-3">
        <label for="latitude" class="form-label">Latitud</label>
        <input type="number" step="any" class="form-control" id="latitude" placeholder="Latitud de la visita" v-model="newVisit.latitude">
      </div>
      <div class="mb-3">
        <label for="longitude" class="form-label">Longitud</label>
        <input type="number" step="any" class="form-control" id="longitude" placeholder="Longitud de la visita" v-model="newVisit.longitude">
      </div>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-success d-block" :disabled="isLoading">Guardar Visita</button>
      </div>
    </form>
  </div>
</div>