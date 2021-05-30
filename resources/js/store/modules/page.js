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
            title: 'هل أنت متأكد؟',
            text: "لن تتمكن من التراجع عن هذا!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'تأكيد الحذف'
        }).then( (result) => {
            if (result.isConfirmed) {
                axios.delete('/api/v1/pages/' + data).then( () => {
                    toast.fire({
                        icon: 'success',
                        title: 'تم حذف الصفحة نجاح'
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
