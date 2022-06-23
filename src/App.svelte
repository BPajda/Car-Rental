<script>
	import Router from "svelte-spa-router";
	import Home from "./routes/Home.svelte";
	import NotFound from "./routes/NotFound.svelte";
	import Header from "./components/Header.svelte";
	import Footer from "./components/Footer.svelte";
	import Tailwindcss from "./Tailwindcss.svelte";
	import Display from "./routes/Display.svelte";
	import AddItem from "./routes/AddItem.svelte";
	import Login from "./routes/Login.svelte";
	import Register from "./routes/Register.svelte";
	import ModPanel from "./routes/ModPanel.svelte";
	import Archive from "./routes/Archive.svelte";
	import Admin from "./routes/Admin.svelte";
</script>

<Tailwindcss />

<Header />

<Router
	routes={{ '/': Home, '/display': Display, '/archive': Archive, '/admin': Admin, '/login': Login, '/register': Register, '/mod': ModPanel, '*': NotFound }} />

<Footer />
