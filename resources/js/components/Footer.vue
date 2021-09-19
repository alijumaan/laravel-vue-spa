<template>
    <footer class="mt-auto py-3 bg-black">
        <div class="container text-center">
            <div class="row justify-content-center">
                <p class="text-white">
                    {{ $t('generals.all_rights_reserved') }}
                    <span class="text-white">© {{ now }}</span>
                    <a class="text-white transition" href="https://alialqahtani.sa" target="_blank">
                        Ali Al Qahtani
                    </a>
                </p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            now: new Date().getFullYear()
        }
    }
}
</script>

<style scoped>
footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 90px;
    line-height: 60px;
}
.bg-black {
    background: black
}
</style>
