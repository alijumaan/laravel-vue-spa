<template>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-black">
        <div class="container">
            <router-link class="navbar-brand text-white" exact :to="{ name: 'home' }">{{ app_title }}</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <div class="navbar-nav mr-auto">
                    <div class="nav-item dropdown">
                        <a id="langDropdown" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            {{ $t('generals.language')}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
                            <button @click="changeLocale('ar')" class="dropdown-item">
                                العربية
                            </button>
                            <button @click="changeLocale('en')" class="dropdown-item">
                                English
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link v-show="!show" class="nav-link" exact :to="{ name: 'login' }">
                            {{ $t('buttons.login') }}
                        </router-link>
                    </li>
                    <li class="nav-item dropdown" v-show="show">
                        <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            {{ name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <router-link class="dropdown-item" exact :to="{ name: 'setting' }">
                                <i class="fas fa-cog fa-fw"></i>&nbsp;{{ $t('generals.settings')}}
                            </router-link>

                            <router-link class="dropdown-item" exact :to="{ name: 'profile' }">
                                <i class="far fa-user fa-fw"></i>&nbsp;{{ $t('generals.profile')}}
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
        name() {
            return this.$store.state.currentUser.user.name;
        }
    },
    methods: {
        changeLocale(locale) {
            localStorage.setItem('locale', locale)
            this.$i18n.locale = locale
        },
        logout() {
            axios.post('/api/v1/logout').then( () => {
                localStorage.removeItem("authToken");
                toast.fire({
                    icon: 'success',
                    title: this.$i18n.t('messages.logout_successfully')
                })
                // this.$router.push({name: 'home'});
                window.location.replace('/')
            })
        }
    }
}
</script>

<style scoped>
.bg-black {
    background: black
}
.navbar-light .navbar-nav .nav-link {
    color: whitesmoke;
}
.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
    color: #e2e7ea;
}
.dropdown-menu {
    color: #fff;
    background-color: #3c4a56;
    border-color: #4684bb;
}
.dropdown-item {
    color: #ffffff;
    background-color: transparent;
}
.navbar-toggler {
    border-radius: .25rem;
    font-size: 1.0rem;
    line-height: 1;
    padding: 0.20rem .65rem;
    background-color: #343a3e;
    border: 1px solid #4684bb;
}
</style>
