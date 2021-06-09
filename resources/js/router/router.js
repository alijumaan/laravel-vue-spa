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
import PageCreate from "../views/Pages/Create.vue";
import PageEdit from "../views/Pages/Edit.vue";
import Login from "../views/auth/Login.vue";
import Profile from "../views/currentUser/Profile.vue";
import Setting from "../views/currentUser/Setting.vue";
import UpdatePassword from "../views/currentUser/UpdatePassword.vue";
import BuildingCreate from "../views/buildings/Create.vue"
import User from "../views/users/Index.vue";
import UserEdit from "../views/users/Edit.vue";
import UserCreate from "../views/users/Create.vue"
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
            name: "buildings.create",
            component: BuildingCreate
        },
        {
            path: "/buildings/:id",
            name: "buildings.show",
            component: BuildingShow
        },
        {
            path: "/buildings/edit/:id",
            name: "buildings.edit",
            component: BuildingEdit
        },
        {
            path: "/extinguishers",
            name: "extinguishers",
            component: Extinguisher
        },
        {
            path: "/extinguishers/:id",
            name: "extinguishers.show",
            component: ExtinguisherShow
        },
        {
            path: "/extinguishers/create",
            name: "extinguishers.create",
            component: ExtinguisherCreate
        },
        {
            path: "/extinguishers/edit/:id",
            name: "extinguishers.edit",
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
            name: "pages.show",
            component: PageShow
        },
        {
            path: "/pages/create",
            name: "pages.create",
            component: PageCreate
        },
        {
            path: "/pages/edit/:id",
            name: "pages.edit",
            component: PageEdit
        },
        {
            path: "/users",
            name: "users",
            component: User
        },
        {
            path: "/users/:id",
            name: "users.edit",
            component: UserEdit
        },
        {
            path: "/users/create",
            name: "users.create",
            component: UserCreate
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
            name: "update_password",
            component: UpdatePassword
        },
        {
            path: "/set-password",
            name: "set_password",
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
            name: "contacts.create",
            component: ContactCreate
        },
        {
            path: "/contacts/:id",
            name: "contacts.show",
            component: ContactShow
        },
        {
            path: "/links",
            name: "links",
            component: Link
        },
        {
            path: "/links/create",
            name: "links.create",
            component: LinkCreate
        },
        {
            path: "/links/edit/:id",
            name: "links.edit",
            component: LinkEdit
        },
        {
            path: "/permissions",
            name: "permissions",
            component: Permission
        },
        {
            path: "/permissions/create",
            name: "permissions.create",
            component: PermissionCreate
        },
        {
            path: "/permissions/edit/:id",
            name: "permissions.edit",
            component: PermissionEdit
        },
    ]
});
