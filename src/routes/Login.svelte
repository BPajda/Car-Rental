<script>
    let login = "";
    let password = "";

    let zmienna = false;

    async function log() {
        let form = new FormData();
        form.set("log", login);
        form.set("pas", password);
        const URL = "./backend/Login.php";
        let res = await fetch(URL, {
            method: "POST",
            body: form,
            mode: "no-cors",
        });

        res = await res.json();
        zmienna = res.zmienna;
        console.log(res);

        if (!zmienna) {
            window.location = "./#/";
            window.location.reload();
        }
    }
</script>

<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
            <h1 class="title-font font-medium text-3xl text-gray-900">
                Znudził ci sie rower a nie masz pieniędzy na nowe auto? TO
                SERWIS IDEALNY DLA CIEBIE!!!
            </h1>
            <p class="leading-relaxed mt-4">
                Wysokiej jakości pojazdy, idealnie sprawdzą się na wyjazd
                firmowy jak i do rodziny.
            </p>
        </div>
        <div
            class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0"
        >
            <h2 class="text-gray-900 text-lg font-medium title-font mb-5">
                Login
            </h2>
            <div class="relative mb-4">
                <label for="login" class="leading-7 text-sm text-gray-600"
                    >Login</label
                >
                <input
                    type="text"
                    bind:value={login}
                    id="login"
                    name="login"
                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                />
            </div>
            <div class="relative mb-4">
                <label for="password" class="leading-7 text-sm text-gray-600"
                    >Password</label
                >
                <input
                    type="password"
                    bind:value={password}
                    id="password"
                    name="pasword"
                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                />
            </div>
            {#if zmienna}
                <div class="relative mb-4">
                    <h1 class="text-red-600">
                        Błędny login, lub nie aktywowany
                    </h1>
                </div>
            {/if}
            <button
                class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                on:click={log}>Login</button
            >
            <p class="text-xs text-gray-500 mt-3">
                Zaloguj się jesli posiadasz konto
            </p>
        </div>
    </div>
</section>
