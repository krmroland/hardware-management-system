{{-- <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" :class="{toggled: $sidebar.showSidebar}" @click="toggleSidebar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
      </button>
      <a class="navbar-brand">{{routeName}}</a>
    </div>
    <div class="navbar-right-menu">
      <ul class="nav navbar-nav navbar-right">
        <li class="open">
          <a href="#" class="dropdown-toggle btn-magnify" data-toggle="dropdown">
            <i class="ti-panel"></i>
            <p>Stats</p>
          </a>
        </li>
           <drop-down title="5 Notifications" icon="ti-bell">
             <li><a href="#">Notification 1</a></li>
             <li><a href="#">Notification 2</a></li>
             <li><a href="#">Notification 3</a></li>
             <li><a href="#">Notification 4</a></li>
             <li><a href="#">Another notification</a></li>
           </drop-down>
        <li>
          <a href="#" class="btn-rotate">
            <i class="ti-settings"></i>
            <p>
              Settings
            </p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav> --}}


<nav class="navbar navbar-expand-lg  bg-secondary navbar-light  bg-nav">
  <a class="navbar-brand" href="/">
    {{ company()->get("name") }}
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/home">Home</a>
      </li>
      @foreach (company()->get("menu") as $item)
      <li class="nav-item">
        <a class="nav-link" href="{{ $item["href"] }}">{{ $item["label"] }}</a>
      </li>
      @endforeach
    </ul>
  </div>
</nav>
