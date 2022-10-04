<template>
    <div>
        <!--Wiill result  in raw json -->
        {{ product }}
    </div>
</template>

<script>
export default {
    name: 'show',
    props: {
        product: Object
    }
}
</script>
