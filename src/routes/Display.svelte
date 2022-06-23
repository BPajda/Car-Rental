<script>
    import Offer from "../components/Offer.svelte";
    let res = [];

    let name = "";
    let dateNow = 0;

    /**@type {"all" | "empty" | "waiting" |"meWaiting" | "meReserved"}*/
    let offerType = "all";

    let offerEnum = [
        ["all", "Wszystkie"],
        ["empty", "Puste"],
        ["waiting", "Oczekujące"],
        ["meWaiting", "Oczekujące przeze mnie"],
        ["meReserved", "Zarezerwowane przeze mnie"],
    ];

    async function getItems() {
        const URL = "./backend/getCars.php";
        let res = await fetch(URL);
        res = await res.json();
        console.log(res);

        dateNow = res.dateNow;
        return res.arr;
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

        if (offerType == "empty") {
            table = table.filter((el) => el.count == 0);
        } else if (offerType == "waiting") {
            table = table.filter((el) => el.count > 0 && !el.reserved);
        } else if (offerType == "meWaiting") {
            table = table.filter((el) => el.myWaiting && !el.reserved);
        } else if (offerType == "meReserved") {
            table = table.filter((el) => el.myWaiting && el.reserved);
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
                {#each res as obj, ind}
                    <Offer {obj} {dateNow} />
                {/each}
            {/await}
        </div>
    </div>
</section>
