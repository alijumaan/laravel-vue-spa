<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="navbar-brand" exact :to="{ name: 'home' }">{{ app_title }}</router-link>
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

                    <div class="nav-item dropdown">
                        <a id="langDropdown" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            {{ $t('generals.language')}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
                            <button @click="changeLocale('ar')"
                                class="dropdown-item">العربية</button>
                            <button @click="changeLocale('en')"
                                    class="dropdown-item">English</button>
                        </div>
                    </div>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="/login" v-show="!show">{{ $t('buttons.login') }}</a>
                    </li>
                    <li class="nav-item dropdown" v-show="show">
                        <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            {{ username }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <router-link class="dropdown-item" exact :to="{ name: 'setting' }">
                                <i class="fas fa-cog fa-fw"></i>&nbsp;{{ $t('buttons.settings')}}
                            </router-link>

                            <router-link class="dropdown-item" exact :to="{ name: 'profile' }">
                                <i class="far fa-user fa-fw"></i>&nbsp;{{ $t('buttons.profile')}}
                            </router-link>

                            <router-link class="dropdown-item" exact :to="{ name: 'update_password' }">
                                <i class="far fa-user fa-fw"></i>{{ $t('buttons.change_password') }}
                            </router-link>

                            <router-link v-if="isAdmin" class="dropdown-item" exact :to="{ name: 'permissions' }">
                                <i class="far fa-user fa-fw"></i>&nbsp;{{ $t('buttons.control_board') }}
                            </router-link>

                            <a href="javascript:void(0)" class="dropdown-item" @click="logout">
                                <i class="fa fa-sign-out-alt fa-fw"></i>{{ $t('buttons.logout') }}
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
            app_title: this.$store.state.app_title,
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
        },
    },
    methods: {
        changeLocale(locale) {
            localStorage.setItem('locale', locale)
            this.$i18n.locale = locale
        },
        logout() {
            this.$store.dispatch('currentUser/logout')
        },
    }
}
</script>

<style scoped>

</style>
