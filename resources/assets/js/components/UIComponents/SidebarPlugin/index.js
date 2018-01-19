
import Sidebar from './SideBar.vue'

const SidebarStore = {

  showSidebar: false,
  sidebarLinks: [
    {
      name: 'Dashboard',
      icon: 'ti-panel',
      path: '/my-account/overview'
    },
    {
      name: 'User Profile',
      icon: 'ti-user',
      path: '/my-account/stats'
    },
    {
      name: 'Communities',
      icon: 'ti-view-list-alt',
      path: '/my-account/communities'
    },
    {
      name: 'Threads',
      icon: 'ti-text',
      path: '/my-account/threads'
    },
    {
      name: 'Icons',
      icon: 'ti-pencil-alt2',
      path: '/my-account/icons'
    },
    {
      name: 'Maps',
      icon: 'ti-map',
      path: '/my-account/maps'
    },
    {
      name: 'Notifications',
      icon: 'ti-bell',
      path: '/my-account/notifications'
    }
  ],
  displaySidebar (value) {
    this.showSidebar = value
  }
}

const SidebarPlugin = {

  install (Vue) {
    Vue.mixin({
      data () {
        return {
          sidebarStore: SidebarStore
        }
      }
    })

    Object.defineProperty(Vue.prototype, '$sidebar', {
      get () {
        return this.$root.sidebarStore
      }
    })
    Vue.component('side-bar', Sidebar)
  }
}

export default SidebarPlugin
