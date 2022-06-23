<script>
    import ModRes from "../components/ModRes.svelte";

    let enabled;
    let timestamp;

    let selectedStatus = "All";
    let selectedUser = "All";

    let userTab = [];

    async function getReservations() {
        let res = await fetch("./backend/getReservations.php", {
            method: "POST",
        });

        let json = await res.json();
        console.log(json);

        userTab = [...new Set(json.arr.map((el) => el.login))];

        enabled = json.eventStatus;
        timestamp = json.timeStamp;

        return json.arr;
    }
    let asyncGet = getReservations();

    $: filtered = asyncGet.then((el) => {
        let tab = el;

        if (selectedStatus != "All") {
            tab = tab.filter((el1) => el1.id_status == selectedStatus);
        }

        if (selectedUser != "All") {
            tab = tab.filter((el1) => el1.login == selectedUser);
        }

        return tab;
    });

    async function submitTime() {
        let form = new FormData();
        form.set("enabled", enabled);
        form.set("timestamp", timestamp);

        let res = await fetch("./backend/SetSheduler.php", {
            method: "POST",
            body: form,
        });
    }
</script>

{#await filtered}
    Pobieram
{:then res}
    <div>
        <input type="number" bind:value={timestamp} />

        <label class="switch">
            <input type="checkbox" bind:checked={enabled} />
            <span class="slider round" />
        </label>

        <button
            class="text-white bg-green-500 border-0 py-1 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
            on:click={submitTime}
        >
            Potwierdź
        </button>
    </div>

    <div>
        <select name="" id="" bind:value={selectedStatus}>
            <option value={"All"}>Wszystkie</option>
            <option value={"1"}>Zaakceptowany</option>
            <option value={"2"}>Odrzucony</option>
            <option value={"3"}>Oczekujący</option>
            <option value={"4"}>Zakończone</option>
        </select>
        <select name="" id="" bind:value={selectedUser}>
            <option value={"All"}>Wszystkie</option>
            {#each userTab as login, ind}
                <option value={login}>{login}</option>
            {/each}
        </select>
    </div>
    <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"
                >
                    Auto
                </th>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                >
                    User
                </th>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                >
                    StartTime
                </th>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                >
                    EndTime
                </th>
                <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"
                >
                    Status
                </th>
                <th
                    class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"
                />
            </tr>
        </thead>
        <tbody>
            {#each res as obj, ind}
                <ModRes data={obj} />
            {/each}
        </tbody>
    </table>
{/await}

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    input:checked + .slider {
        background-color: #2196f3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196f3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
