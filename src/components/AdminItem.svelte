<script>
    export let data;
    async function accept() {
        let form = new FormData();
        form.set("id", data.id);
        form.set("aktywny", data.aktywny);
        form.set("prawa_id", data.prawa_id);
        let res = await fetch("./backend/AcceptUser.php", {
            method: "POST",
            body: form,
        });

        let json = await res.json();

        window.location.reload();
    }
</script>

<tr>
    <td class="border-t-2 border-gray-200 px-4 py-3">{data.login}</td>
    <td class="border-t-2 border-gray-200 px-4 py-3">
        {#if data.prawa_id != 1}
            <select name="" id="" bind:value={data.aktywny}>
                <option value="0">Nieaktywny</option>
                <option value="1">Aktywny</option>
            </select>
        {:else}Aktywny{/if}
    </td>
    <td class="border-t-2 border-gray-200 px-4 py-3">
        {#if data.prawa_id != 1}
            <select name="" id="" bind:value={data.prawa_id}>
                <option value="2">Mod</option>
                <option value="3">User</option>
            </select>
        {:else}{data.prawa_id}{/if}
    </td>
    <td class="border-t-2 border-gray-200 w-10 text-center">
        <button
            class="text-white bg-green-500 border-0 py-1 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
            on:click={accept}>
            Zatwierdź</button>
    </td>
</tr>
