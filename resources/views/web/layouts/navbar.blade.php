<nav class="navbar navbar-expand-sm navbar-dark bg-dark border-bottom">
  <a class="navbar-brand ml-2 font-weight-bold" href="{{route('products.index')}}">
   <span id="burgundy">Chefaa</span><span id="orange">Task</span></a> 
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor" aria-controls="navbarColor" aria-expanded="false" aria-label="Toggle navigation"> 
      <span class="navbar-toggler-icon"></span> 
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('products.create')}}">Add Product <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <div class="collapse navbar-collapse" id="navbarColor">
         <ul class="navbar-nav">
            <li class="nav-item rounded bg-light search-nav-item">
               <input type="text" id="search" autocomplete="off" class="bg-light" placeholder="Search Panadol, Omega-3, Otrivin"><span class="fa fa-search text-muted"></span>
            </li>
            <li>
          </li>
       </ul>
      </div>
    </div>

</nav>