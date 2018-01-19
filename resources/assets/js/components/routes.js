import DashboardLayout from './components/Dashboard/Layout/DashboardLayout.vue';
// GeneralViews
import NotFound from './components/GeneralViews/NotFoundPage.vue';

// Admin pages
import Overview from './components/Dashboard/Views/Overview.vue';
import UserProfile from './components/Dashboard/Views/UserProfile.vue';

import Communities from './components/communities/index';

const routes = [
  {
    path: '/',
    component: DashboardLayout,
    redirect: '/my-account/overview'
  },


  {
    path: '/my-account',
    component: DashboardLayout,
    redirect: '/my-account/stats',
    children: [
      {
        path: 'overview',
        name: 'overview',
        component: Overview
      },
      {
        path: 'stats',
        name: 'stats',
        component: UserProfile
      },
      {
        path: 'communities',
        name: 'Communities',
        component: Communities
      },
      // {
      //   path: 'notifications',
      //   name: 'notifications',
      //   component: Notifications
      // },
      // {
      //   path: 'icons',
      //   name: 'icons',
      //   component: Icons
      // },
      // {
      //   path: 'maps',
      //   name: 'maps',
      //   component: Maps
      // },
      // {
      //   path: 'typography',
      //   name: 'typography',
      //   component: Typography
      // },
      // {
      //   path: 'table-list',
      //   name: 'table-list',
      //   component: TableList
      // }
    ]
  },
  { path: '*', component: NotFound }
]


export default routes
