<template>
    <div>
        <div class="flex items-center justify-center mb-6 gap-12 text-lg">
            <a id="silversurfer_link" href="#!" class="link-primary selected">Silver Surfer (4.x) episodes</a>
            <a id="orion_link" href="#!" class="link-primary">Orion (3.x) episodes</a>
        </div>
        <div class="flex items-center justify-center p-y-8">
            <div class="flex gap-12">
                <img class="w-1/2" src="https://picsum.photos/200/200?random=1" />
                <img class="w-1/2" src="https://picsum.photos/200/200?random=2" />
                <img class="w-1/2" src="https://picsum.photos/200/200?random=3" />
                <img class="w-1/2" src="https://picsum.photos/200/200?random=4" />
            </div>

            <div class="flex gap-12 hidden">
                <img class="w-1/2" src="https://picsum.photos/200/200?random=5" />
                <img class="w-1/2" src="https://picsum.photos/200/200?random=6" />
                <img class="w-1/2" src="https://picsum.photos/200/200?random=7" />
                <img class="w-1/2" src="https://picsum.photos/200/200?random=8" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                greeting: 'Hello World!'
            }
        },
        created() {
            // props are exposed on `this`.
            console.log(this.foo)
        }
    }
</script>

<style>
    .greeting {
        color: red;
        font-weight: bold;
    }
</style>
