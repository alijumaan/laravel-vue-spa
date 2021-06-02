<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="navbar-brand" exact :to="{ name: 'home' }">الوقاية</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <div class="navbar-nav mr-auto">
<!--                    <div v-for="page in pages" v-if="show">-->
<!--                        <router-link class="nav-link" exact :to="{ name: 'pages.show', params: { id: page.slug } }">-->
<!--                            {{ page.title }}-->
<!--                        </router-link>-->
<!--                    </div>-->
                    <router-link v-if="isAdmin" class="nav-link" exact :to="{ name: 'links' }">
                        الروابط
                    </router-link>
                    <router-link v-if="isAdmin" class="nav-link" exact :to="{ name: 'permissions.create' }">
                        انشاء صلاحية
                    </router-link>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="/login" v-show="!show">تسجيل دخول</a>
                    </li>
                    <li class="nav-item dropdown" v-show="show">
                        <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            {{ username }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <router-link class="dropdown-item" exact :to="{ name: 'setting' }">
                                <i class="fas fa-cog fa-fw"></i>&nbsp;الإعدادات
                            </router-link>

                            <router-link class="dropdown-item" exact :to="{ name: 'profile' }">
                                <i class="far fa-user fa-fw"></i>&nbsp;الصفحة الشخصية
                            </router-link>

                            <router-link class="dropdown-item" exact :to="{ name: 'update_password' }">
                                <i class="far fa-user fa-fw"></i>تغير كلمة المرور
                            </router-link>

                            <router-link v-if="isAdmin" class="dropdown-item" exact :to="{ name: 'permissions' }">
                                <i class="far fa-user fa-fw"></i>&nbsp;لوحة التحكم
                            </router-link>

                            <a href="javascript:void(0)" class="dropdown-item" @click="logout">
                                <i class="fa fa-sign-out-alt fa-fw"></i>خروج
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<script>
export default {
    data() {
        return {
            show: this.$store.state.show_content,
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.currentUser.isAdmin;
        },
        username() {
            return this.$store.state.currentUser.user.name;
        },
        pages() {
            return this.$store.state.page.pages;
        }
    },
    created() {
        if (this.show) {
            this.$store.dispatch('currentUser/isAdmin');
            this.$store.dispatch('currentUser/user');
            this.$store.dispatch('page/getPagesUrl');
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('currentUser/logout')
        },
    }
}
</script>

<style scoped>

</style>
