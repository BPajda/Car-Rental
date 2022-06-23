<script>
    /**@type {"Admin"|"Mod"|"User"|"unLogged"}*/
    let status = "unLogged";

    async function getUserStatus() {
        const URL = "./backend/getUserStatus.php";
        let res = await fetch(URL);

        res = await res.json();

        status = res.zmienna;
    }
    getUserStatus();
</script>

<header class="text-gray-600 body-font">
    <div
        class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center"
    >
        <a
            href="#/"
            class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0"
        >
            <img src="./assets/logo.png" alt="aaaaaaa" style="height:100px;" />
        </a>
        <nav
            class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center"
        >
            {#if status != "unLogged"}
                <a class="mr-5 hover:text-gray-900" href="#/display">Display</a>
                <a class="mr-5 hover:text-gray-900" href="#/archive">Archive</a>
            {/if}
            {#if status == "Admin"}
                <a class="mr-5 hover:text-gray-900" href="#/admin">
                    Admin Panel
                </a>
            {/if}
            {#if status == "Mod" || status == "Admin"}
                <a class="mr-5 hover:text-gray-900" href="#/mod"> Mod Panel </a>
            {/if}
            {#if status == "unLogged"}
                <a class="mr-5 hover:text-gray-900" href="#/register"
                    >Register</a
                >
                <a class="mr-5 hover:text-gray-900" href="#/login">Login</a>
            {:else}
                <a class="mr-5 hover:text-gray-900" href="./backend/logout.php"
                    >Logout</a
                >
            {/if}
        </nav>
    </div>
</header>

<style>
    a {
        font-size: 25px;
    }
</style>
