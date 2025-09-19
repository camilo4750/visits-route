<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasManageVisit"
  aria-labelledby="offcanvasManageVisitLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasManageVisitLabel">Gestionar visita</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="actions d-flex gap-2 mb-4">
      <button class="btn-action btn-view" @click="showView">
        <i class="fas fa-eye"></i> Ver
      </button>
      <button class="btn-action btn-edit" @click="showEdit">
        <i class="fas fa-edit"></i> Editar
      </button>
      <button class="btn-action btn-delete">
        <i class="fas fa-trash-alt"></i> Eliminar
      </button>
    </div>
    <div class="eye-visit" v-show="manageVisitMode === 'view'">
      <h2>Detalle visita</h2>
      <hr class="mt-0">
      <p><strong>Nombre:</strong> @{{ visit.name }}</p>
      <p><strong>Email:</strong> @{{ visit.email }}</p>
      <p><strong>Latitud:</strong> @{{ visit.latitude }}</p>
      <p><strong>Longitud:</strong> @{{ visit.longitude }}</p>
      <p><strong>Fecha de creación:</strong> @{{ visit.createdAt }}</p>
      <p><strong>Fecha de actualización:</strong> @{{ visit.updated_at }}</p>
    </div>

    <div class="edit-visit" v-show="manageVisitMode === 'edit'">
      <h2>Editar visita</h2>
      <hr class="mt-0">
      <form action="">
        <div class="mb-3">
          <label for="visitName" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="visitName" v-model="visit.name">
        </div>
        <div class="mb-3">
          <label for="visitEmail" class="form-label">Email</label>
          <input type="email" class="form-control" id="visitEmail" v-model="visit.email">
        </div>
        <div class="mb-3">
          <label for="visitLatitude" class="form-label">Latitud</label>
          <input type="text" class="form-control" id="visitLatitude" v-model="visit.latitude">
        </div>
        <div class="mb-3">
          <label for="visitLongitude" class="form-label">Longitud</label>
          <input type="text" class="form-control" id="visitLongitude" v-model="visit.longitude">
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>