const state = {
    pages: {}
}

const getters = {}

const actions = {
    getPagesUrl(context) {
        context.commit('setPagesUrl')
    },
    delete_page(context, data) {
        context.commit('delete_page', data)
    }

}

const mutations = {
    setPagesUrl(state) {
        axios.get("/api/v1/pages").then(response => {
            state.pages = response.data.pages
        });
    },
    delete_page(state, data) {
        swal.fire({
            title: this.$i18n.t('messages.are_you_sour?'),
            text: this.$i18n.t('messages.You_wont_be_able_to_undo_this'),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: this.$i18n.t('messages.delete_confirmation')
        }).then( (result) => {
            if (result.isConfirmed) {
                axios.delete('/api/v1/pages/' + data).then( () => {
                    toast.fire({
                        icon: 'success',
                        title: this.$i18n.t('messages.deleted_successfully')
                    })
                    location.reload();
                })

            }
        })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
