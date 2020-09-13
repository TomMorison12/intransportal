<template>
    <div>
        <div :id="name" class="overlay">
            <div class="modal">
                <slot></slot>

                <a class="close" href="#">&times;</a>
            </div>


        </div>
    </div>
</template>

<script>
    export default {

        props: ['name'],
    }
</script>

<style type="text/css">
    .overlay {
        visibility: hidden;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .7);
        transition: opacity 3s;
        opacity: 0
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .modal {
        position: relative;
        width: 600px;
        height: 400px;
        overflow-y: auto;
        max-width: 80%;
        background: white;
        border-radius: 8px;
        padding: 1em 2em;
        display:inline;
    }

    .modal .close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: grey;
        text-decoration: none;
    }

    .overlay .cancel {
        position: absolute;
        width: 100%;
        height: 100%;
    }
</style>
