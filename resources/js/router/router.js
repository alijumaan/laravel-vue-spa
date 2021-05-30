import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Building from "../views/buildings/Index.vue";
import BuildingShow from "../views/buildings/Show.vue";
import BuildingEdit from "../views/buildings/Edit.vue";
import Extinguisher from "../views/extinguishers/Index.vue";
import ExtinguisherShow from "../views/extinguishers/Show.vue";
import ExtinguisherCreate from "../views/extinguishers/Create.vue";
import ExtinguisherEdit from "../views/extinguishers/Edit.vue";
import Pages from "../views/Pages/Index.vue";
import PageShow from "../views/Pages/Show.vue";
import PageEdit from "../views/Pages/Edit.vue";
import Profile from "../views/user/Profile.vue";
import Login from "../views/auth/Login.vue";
import Setting from "../views/user/Setting.vue";
import UpdatePassword from "../views/user/UpdatePassword.vue";
import BuildingCreate from "../views/buildings/Create.vue"
import UsersIndex from "../views/users/Index.vue";
import UsersEdit from "../views/users/Edit.vue";
import UsersCreate from "../views/users/Create.vue"
import SetPassword from "../views/auth/SetPassword.vue";
import Note from "../views/notes/Notes.vue";
import Contact from "../views/contacts/Index.vue"
import ContactCreate from "../views/contacts/Create.vue"
import ContactShow from "../views/contacts/Show.vue"
import Link from "../views/links/Index.vue";
import LinkCreate from "../views/links/Create.vue";
import LinkEdit from "../views/links/Edit.vue";
import Permission from "../views/permissions/Index";
import PermissionCreate from "../views/permissions/Create.vue";
import PermissionEdit from "../views/permissions/Edit.vue";



export const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'text-dark bg-white',
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/buildings",
            name: "buildings",
            component: Building
        },
        {
            path: "/buildings/create",
            name: "buildingsCreate",
            component: BuildingCreate
        },
        {
            path: "/buildings/:id",
            name: "buildingShow",
            component: BuildingShow
        },
        {
            path: "/buildings/edit/:id",
            name: "buildingEdit",
            component: BuildingEdit
        },
        {
            path: "/extinguishers",
            name: "extinguishers",
            component: Extinguisher
        },
        {
            path: "/extinguishers/:id",
            name: "extinguisherShow",
            component: ExtinguisherShow
        },
        {
            path: "/extinguishers/create",
            name: "extinguisherCreate",
            component: ExtinguisherCreate
        },
        {
            path: "/extinguishers/edit/:id",
            name: "extinguisherEdit",
            component: ExtinguisherEdit
        },
        {
            path: "/profile",
            name: "profile",
            component: Profile
        },
        {
            path: "/pages",
            name: "pages",
            component: Pages
        },
        {
            path: "/pages/:id",
            name: "pageShow",
            component: PageShow
        },
        {
            path: "/pages/edit/:id",
            name: "pageEdit",
            component: PageEdit
        },
        {
            path: "/users",
            name: "users",
            component: UsersIndex
        },
        {
            path: "/users/:id",
            name: "usersEdit",
            component: UsersEdit
        },
        {
            path: "/users/create",
            name: "usersCreate",
            component: UsersCreate
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/user/setting",
            name: "setting",
            component: Setting
        },
        {
            path: "/user/profile",
            name: "profile",
            component: Profile
        },
        {
            path: "/user/password",
            name: "updatePassword",
            component: UpdatePassword
        },
        {
            path: "/set-password",
            name: "setPassword",
            component: SetPassword
        },
        {
            path: "/notes",
            name: "notes",
            component: Note
        },
        {
            path: "/contacts",
            name: "contacts",
            component: Contact
        },
        {
            path: "/contacts/create",
            name: "contactsCreate",
            component: ContactCreate
        },
        {
            path: "/contacts/:id",
            name: "contactShow",
            component: ContactShow
        },
        {
            path: "/links",
            name: "links",
            component: Link
        },
        {
            path: "/links/create",
            name: "linksCreate",
            component: LinkCreate
        },
        {
            path: "/links/edit/:id",
            name: "linksEdit",
            component: LinkEdit
        },
        {
            path: "/permissions",
            name: "permissions",
            component: Permission
        },
        {
            path: "/permissions/create",
            name: "permissionsCreate",
            component: PermissionCreate
        },
        {
            path: "/permissions/edit/:id",
            name: "permissionsEdit",
            component: PermissionEdit
        },
    ]
});
