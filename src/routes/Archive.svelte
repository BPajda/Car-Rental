<script>
    let res = [];

    let name = "";

    /**@type {"all" |"canceled"|"ended"}*/
    let offerType = "all";

    let offerEnum = [
        ["canceled", "Odrzucone"],
        ["ended", "Zakończone"],
    ];

    async function getItems() {
        const URL = "./backend/getArchive.php";
        let res = await fetch(URL);
        res = await res.json();
        console.log(res);
        return res;
    }

    let asyncItems = getItems();

    $: filtered = asyncItems.then((r) => {
        let table = r.filter((el) =>
            Object.values(el).some((element) =>
                element
                    .toString()
                    .toLowerCase()
                    .includes(name.toString().toLowerCase())
            )
        );

        if (offerType == "canceled") {
            table = table.filter((el) => el.id_status == 2);
        } else if (offerType == "ended") {
            table = table.filter((el) => el.id_status == 4);
        }

        return table;
    });
</script>

<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <input type="text" bind:value={name} />

            <select name="" id="" bind:value={offerType}>
                {#each offerEnum as arr, ind}
                    <option value={arr[0]}>{arr[1]}</option>
                {/each}
            </select>
        </div>
        <div class="lg:w-2/3 w-full mx-auto overflow-auto flex flex-wrap">
            {#await filtered}
                aaa
            {:then res}
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                Auto
                            </th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                StartTime
                            </th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                EndTime
                            </th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Zapłata
                            </th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        {#each res as obj, ind}
                            <tr>
                                <td
                                    class="border-t-2 border-gray-200 px-4 py-3">
                                    {obj.name}
                                </td>
                                <td
                                    class="border-t-2 border-gray-200 px-4 py-3">
                                    {obj.start}
                                </td>
                                <td
                                    class="border-t-2 border-gray-200 px-4 py-3">
                                    {obj.end}
                                </td>

                                <td
                                    class="border-t-2 border-gray-200 px-4 py-3">
                                    {obj.id_status == 4 ? parseFloat(obj.cena) * ((new Date(obj.end).getTime() - new Date(obj.start).getTime()) / (3600 * 24 * 1000)) + ' zł' : ''}
                                </td>
                                <td
                                    class="border-t-2 border-gray-200 px-4 py-3">
                                    {obj.id_status == 2 ? 'Odrzucone' : 'Zakończone'}
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            {/await}
        </div>
    </div>
</section>
