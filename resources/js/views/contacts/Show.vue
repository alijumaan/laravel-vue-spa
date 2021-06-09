<template>
    <div class="card shadow-sm">
        <div class="card-header d-flex">
            <div class="ml-auto">
                <router-link exact :to="{name: 'contacts', params: { id: contact.id }}"
                             class="ml-auto btn btn-primary btn-sm">
                    {{ $t('actions.back') }}
                </router-link>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    <th>{{ $t('fields.sender') }}</th>
                    <td>{{ contact.name }}</td>
                </tr>
                <tr>
                    <th>{{ $t('fields.email') }}</th>
                    <td>{{ contact.email }}</td>
                </tr>
                <tr>
                    <th>{{ $t('fields.title') }}</th>
                    <td>{{ contact.title }}</td>
                </tr>
                <tr>
                    <th>{{ $t('fields.content') }}</th>
                    <td>{{ contact.body }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            contact: {}
        }
    },
    created() {
        this.showMessage();
    },
    methods: {
        showMessage() {
            axios.get(`/api/v1/contacts/${this.$route.params.id}`).then(response => {
                this.contact = response.data.contact
            })
        },
    }
}
</script>

<style scoped></style>
