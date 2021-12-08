<div>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mt-2">
            <div class="btn-group">
                <button class="btn btn-dark ml-1" wire:click="categorias('aperitivo')">Aperitivos</button>
                <button class="btn btn-dark ml-1" wire:click="categorias('principal')">Principales</button>
                <button class="btn btn-dark ml-1" wire:click="categorias('bebida')">Bebidas</button>
                <button class="btn btn-dark ml-1" wire:click="categorias('postre')">Postres</button>
              </div>
        </div>
        <div class="mb-3 mt-3 col-12 d-flex justify-content-center">
         <input class="col-10" type="text" wire:model="search"  placeholder="buscador">
        </div>
    </div>
    <div class="container">
        @foreach ($productos as $producto)
        <div class="row d-flex justify-content-center rounded mt-2 ">
            <div style="height: 80px;" class="col-2 border-bottom border-secondary Regular shadow d-flex justify-content-center align-items-center">
                <img style="height: 60px; width:60px;" class="rounded-circle" src="/images/{{ $producto->imagen }}" alt="">
            </div>
            <div style="height: 80px;" class="col-7 border-bottom border-secondary Regular shadow d-flex justify-content-start align-items-center">
                <h5>{{ $producto->titulo }}</h5>
            </div>
            <div style="height: 80px;" class="col-2 border-bottom border-secondary Regular shadow  d-flex justify-content-center align-items-center">
                <p> <strong>${{ $producto->precio }}</strong></p>
            </div>
        </div>
        @endforeach
      

        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
    </div>
</div>
