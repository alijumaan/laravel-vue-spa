<template>
    <div>
        <div class="row  bg-white p-3 mb-4 text-muted">
            <div class="col-md-3 mb-3">
                <img class="profile" :src="user.avatar" alt="لم تضاف الصورة" />
            </div>

            <div class="col-md-9">
                <h5>{{ user.username }}</h5>
                <p class="word-break">{{ user.bio }}</p>
            </div>
        </div>

        <div class="row bg-white">
            <div  class="col-md-12">
                <div class=" bg-white p-2 mb-4 text-muted">
                    <div class="card-title">
                        <h5 class="text-dark">المباني المسؤول عنها: </h5>
                    </div>

                    <div v-for="(building, index) in user.buildings"
                         v-if="user.buildings_count > 0"
                        class="card-columns p-2" style="display: block" >
                        <h5>
                            {{ index + 1 }} -
                            <span class="text-danger">{{  building.name }}</span>
                        </h5>
                    </div>
                    <p class="text-center" v-if="!user.buildings_count > 0">لا يوجد مباني تحت مسؤوليتك!</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
      user() {
          return this.$store.state.currentUser.user;
      }
    },
    created() {
        this.$store.dispatch('currentUser/user');
    }
}
</script>

<style scoped>

</style>
