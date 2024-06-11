<template>
    <div>


        <!--        <p>-->
        <!--            &lt;!&ndash; use router-link component for navigation. &ndash;&gt;-->
        <!--            &lt;!&ndash; specify the link by passing the `to` prop. &ndash;&gt;-->
        <!--            &lt;!&ndash; `<router-link>` will be rendered as an `<a>` tag by default &ndash;&gt;-->
        <!--            <router-link to="/welcome">Go to Foo</router-link>-->
        <!--            <router-link to="/contacts">Go to Bar</router-link>-->
        <!--        </p>-->


        <!--         component matched by the route will render here -->
        <router-view></router-view>
    </div>
</template>


<script>
export default {
    name: "App",

    mounted() {
    },
    watch: {},

    components: {},
    props: {},

    data() {
        return {};
    },
    methods: {},
};


</script>


<style lang="scss">
</style>
