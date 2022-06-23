<script>
    export let data;

    let enumStatus = {
        1: "zakceptowany",
        2: "odrzucony",
        3: "oczekujący",
        4: "zakończone",
    };
    async function accept() {
        let form = new FormData();
        form.set("id", data.id);
        form.set("start", data.start);

        form.set("end", data.end);

        let res = await fetch("./backend/Accept.php", {
            method: "POST",
            body: form,
        });

        let json = await res.json();

        window.location.reload();
        console.log(json);
    }
    async function del() {
        let form = new FormData();
        form.set("id", data.id);

        let res = await fetch("./backend/del.php", {
            method: "POST",
            body: form,
        });

        let json = await res.json();
        console.log(json);

        window.location.reload();
    }
</script>

<tr>
    <td class="border-t-2 border-gray-200 px-4 py-3">{data.name}</td>
    <td class="border-t-2 border-gray-200 px-4 py-3">{data.login}</td>
    <td class="border-t-2 border-gray-200 px-4 py-3">
        <input type="date" bind:value={data.start} />
    </td>
    <td class="border-t-2 border-gray-200 px-4 py-3">
        <input type="date" bind:value={data.end} />
    </td>
    <td class="border-t-2 border-gray-200 px-4 py-3">
        {enumStatus[data.id_status]}
    </td>
    <td class="border-t-2 border-gray-200 w-10 text-center">
        {#if data.id_status == 1 || data.id_status == 3}
            <button
                class="text-white bg-green-500 border-0 py-1 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                on:click={accept}
            >
                Zatwierdź</button
            >

            <button
                class="text-white bg-red-500 border-0 py-1 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                on:click={del}
            >
                del</button
            >
        {/if}
    </td>
</tr>

<style>
    /* your styles go here */
</style>
