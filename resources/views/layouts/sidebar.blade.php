<div class="sidebar" data-background-color="black" data-active-color="success">
 
  <div class="sidebar-wrapper" id="style-3">
    <div class="logo">
      <a href="#" class="simple-text">
          <div class="logo-img">
              <img src="/img/vue-logo.png" alt="">
          </div>
       {{ company()->get('name') }}
      </a>
    </div>
    <slot>

    </slot>
    <ul class="nav">
      <!--By default vue-router adds an active class to each route link. This way the links are colored when clicked-->
      <li>
        <a>
          <i class="fa fa-user"></i>

          <p>
            Customers
          </p>
        </a>
      </li>
     {{--  <router-link 
        v-for="(link,index) in sidebarLinks" 
        :to="link.path" tag="li" 
        :ref="link.name"
        :key="index">
        <a>
          <i :class="link.icon"></i>

          <p>{{link.name}}
          </p>
        </a>
      </router-link> --}}
    </ul>
   {{--  <moving-arrow :move-y="arrowMovePx">

    </moving-arrow> --}}
  </div>
</div>
