<template>
    <div>
        <!--this will result in raw json-->
        {{ category }}
    </div>
</template>

<script>
export default {
    name: 'show',
    props: {
        category: Object
    }
}
</script>
