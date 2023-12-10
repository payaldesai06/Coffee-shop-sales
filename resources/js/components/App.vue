<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link exact-active-class="active" to="/sales" class="nav-item nav-link">New ☕️ Sales</router-link>
                <router-link exact-active-class="active" to="/shipping" class="nav-item nav-link">Shipping Partners 🚚</router-link>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
    export default {}
</script>
