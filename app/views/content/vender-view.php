  <div class="container py-4">
        <!-- Encabezado -->
        <div class="row mb-4">
            <div class="col">
                <h2 class="mb-3">Sistema de Ventas - Librería</h2>
            </div>
        </div>

        <!-- Sección de búsqueda y cliente -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-barcode"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Escanear código o buscar libro..." id="searchBook">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="clientSelect">
                    <option value="">Seleccionar Cliente</option>
                    <option value="1">Juan Pérez</option>
                    <option value="2">María García</option>
                    <option value="3">Carlos López</option>
                </select>
            </div>
        </div>

        <!-- Tabla de productos -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Código</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Cien años de soledad</td>
                                <td>Gabriel García Márquez</td>
                                <td>$25.00</td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="1" min="1" style="width: 70px">
                                </td>
                                <td>$25.00</td>
                                <td>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>El principito</td>
                                <td>Antoine de Saint-Exupéry</td>
                                <td>$15.00</td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="2" min="1" style="width: 70px">
                                </td>
                                <td>$30.00</td>
                                <td>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Resumen de la venta -->
        <div class="row">
            <div class="col-md-6 ms-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="mb-0">Subtotal:</h6>
                            <span>$55.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="mb-0">IVA (16%):</h6>
                            <span>$8.80</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Total:</h5>
                            <h5 class="mb-0">$63.80</h5>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-success">
                                <i class="fas fa-cash-register"></i> Procesar Venta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>