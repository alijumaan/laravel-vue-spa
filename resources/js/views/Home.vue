<template>
    <div class="row justify-content-center">
        <!--  Buildings   -->
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <router-link class="card-body text-white" style="text-decoration: none" exact :to="{name: 'buildings'}">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-th-list"></i>
                    </div>
                    <div class="mr-5">{{ $t('generals.buildings') }} <span style="display: block"></span></div>
                </router-link>
                <router-link class="card-footer text-white clearfix small z-1" exact :to="{name: 'buildings'}">
                    <span class="float-left">{{ $t('generals.more') }}</span>
                    <span class="float-right"><i class="fa fa-angle-right"></i></span>
                </router-link>
            </div>
        </div>

        <!--  Users   -->
        <div v-if="isAdmin" class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <router-link class="card-body text-white" style="text-decoration: none" exact :to="{name: 'users'}">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-users"></i>
                    </div>
                    <div class="mr-5">{{ $t('generals.members') }}</div>
                </router-link>
                <router-link class="card-footer text-white clearfix small z-1" exact :to="{name: 'users'}">
                    <span class="float-left">{{ $t('generals.more') }}</span>
                    <span class="float-right"><i class="fa fa-angle-right"></i></span>
                </router-link>
            </div>
        </div>

        <!--  Extinguisher   -->
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">

                <router-link class="card-body text-white" style="text-decoration: none" exact :to="{name: 'extinguishers'}">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">{{ $t('generals.extinguishers') }}
                    </div>
                </router-link>
                <router-link class="card-footer text-white clearfix small z-1" exact :to="{name: 'extinguishers'}">
                    <span class="float-left">{{ $t('generals.more') }}</span>
                    <span class="float-right"><i class="fa fa-angle-right"></i></span>
                </router-link>
            </div>
        </div>

        <!--  Notes   -->
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <router-link class="card-body text-white" style="text-decoration: none" exact :to="{name: 'notes'}">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">{{ $t('generals.notes') }}<span style="display: block"></span></div>
                </router-link>
                <router-link class="card-footer text-white clearfix small z-1" exact :to="{name: 'notes'}">
                    <span class="float-left">{{ $t('generals.more') }}</span>
                    <span class="float-right"><i class="fa fa-angle-right"></i></span>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    setup() {
        const store = useStore()
        const isAdmin = computed(() => { return store.state.currentUser.isAdmin })

        return { isAdmin }
    }
}
</script>
