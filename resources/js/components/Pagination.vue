<template>
    <nav v-show="pages > 1">
        <ul class="pagination justify-content-start">
            <li class="page-item" @click="changePage(1)">
                <a class="page-link" href="#">{{ $t('buttons.first') }}</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous"
                   @click="changePage(page - 1)">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next"
                   @click="changePage(page + 1)">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item" @click="changePage(pages)">
                <a class="page-link" href="#">{{ $t('buttons.last') }}</a>
            </li>
        </ul>
        <p class="mr-4">Page: {{ page }} of {{ pages }}</p>
    </nav>

</template>

<script>
export default {
    name: 'Pagination',
    props: ['page', 'viewingAmount', 'total'],
    computed: {
        pages() {
            const remainder = this.total % this.viewingAmount
            const totalPages = this.total / this.viewingAmount

            return remainder ? Math.ceil(totalPages) : totalPages
        }
    },
    methods: {
        changePage(page) {
            if (page <= this.pages && page > 0) {
                this.$emit('change', [page, this.viewingAmount])
            }
        }
    },

}
</script>

<style lang="scss" scoped>

.pagination {
    display: flex;
    justify-content: flex-end;
    margin-right: 10%;

    li {
        list-style-type: none;
    }

    .back,
    .far-back,
    .forward,
    .far-forward {
        width: 20px;
        cursor: pointer;
        text-align: center
    }

    .back,
    .far-back {
        justify-content: flex-start;
    }

    .forward,
    .far-forward {
        justify-content: flex-end;
    }
}
</style>
