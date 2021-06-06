<template>
    <footer class="mt-auto py-3 bg-dark">
        <div class="container text-center">
            <div class="row justify-content-center">
                <p class="text-white">
                    {{ $t('allRightsReserved') }}
                    <span class="text-white">© {{ now }}</span>
                    <a class="text-primary transition" href="https://www.alijumaan.com"> alijumaan.com</a></p>
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
</style>
