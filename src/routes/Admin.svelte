<script>
    import AdminItem from "../components/AdminItem.svelte";

    let selectedStatus = "All";
    let selectedActivated = "All";

    async function getUsers() {
        let res = await fetch("./backend/getUsers.php", {
            method: "POST",
        });

        let json = await res.json();
        console.log(json);

        return json;
    }

    let asyncGet = getUsers();

    $: filtered = asyncGet.then((el) => {
        let tab = el;

        if (selectedStatus != "All") {
            tab = tab.filter((el1) => el1.prawa_id == selectedStatus);
        }

        if (selectedActivated != "All") {
            tab = tab.filter((el1) => el1.aktywny == selectedActivated);
        }

        return tab;
    });
</script>

<style>
</style>

{#await filtered}
    Pobieram
{:then res}
    <div>
        <select name="" id="" bind:value={selectedStatus}>
            <option value={'All'}>Wszystkie</option>
            <option value={'1'}>Admin</option>
            <option value={'2'}>Mod</option>
            <option value={'3'}>User</option>
        </select>
        <select name="" id="" bind:value={selectedActivated}>
            <option value={'All'}>Wszystkie</option>
            <option value={'0'}>Nieaktywni</option>
            <option value={'1'}>Aktywni</option>
        </select>
    </div>
    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                    login
                </th>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                    Aktywny
                </th>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                    Prawa
                </th>
                <th
                    class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br" />
            </tr>
        </thead>
        <tbody>
            {#each res as obj, ind}
                <AdminItem data={obj} />
            {/each}
        </tbody>
    </table>
{/await}
