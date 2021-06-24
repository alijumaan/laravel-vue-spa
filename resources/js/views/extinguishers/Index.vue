<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div v-if="isSupervisor" class="d-flex mb-3">
                <router-link :to="{ name: 'extinguishers.create'}"
                             class="ml-auto btn btn-primary btn-sm">
                    <h6>{{ $t('buttons.pull_extinguisher') }}</h6>
                </router-link>
            </div>
            <div class="card shadow">
                <div class="p-3 d-flex">
                    <h4>{{ $t('titles.extinguishers_under_maintenance') }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="">
                        <tr class="bg-dark text-white">
                            <th>{{ $t('fields.type') }}</th>
                            <th>{{ $t('fields.count') }}</th>
                            <th width="10%">{{ $t('fields.action') }}</th>
                        </tr>
                        </thead>
                        <tbody v-if="extinguishers.length > 0">
                        <tr v-for="extinguisher in extinguishers">
                            <td>{{ extinguisher.extinguisherType }}</td>
                            <td>{{ extinguisher.extinguisherCount }}</td>
                            <td>
                                <router-link
                                    :to="{ name: 'extinguishers.show', params: { id: extinguisher.id } }">
                                    {{ $t('fields.details') }}
                                </router-link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p v-show="!extinguishers.length > 0"
                       class="text-center">{{ $t('messages.no_results') }}</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    beforeRouteEnter(to, from, next) {
        if (!localStorage.getItem("authToken")) {
            return next({name: 'login'})
        }
        next();
    },
    setup() {
        const store = useStore()

        const isSupervisor = computed(() => {
            return store.state.currentUser.isSupervisor
        })

        const extinguishers = computed(() => {
            return store.state.extinguisher.extinguishers
        })

        if (store.state.loaded_extinguishers === true) {
            store.dispatch('extinguisher/getExtinguishers')
            store.state.loaded_extinguishers = false
        }

        return {
            isSupervisor,
            extinguishers
        }
    }
}
</script>

<style scoped>
a {
    text-decoration: none !important;
}
</style>
