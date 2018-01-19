<nav class="navbar navbar-expand-lg  bg-dark navbar-dark fixed-top bg-nav">
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
      <li class="nav-item">
        <a class="nav-link" href="/profile">My Account</a>
      </li>
     <li class="nav-item">
       <a class="nav-link" href="/logout">Logout</a>
     </li>
    </ul>
  </div>
</nav>
