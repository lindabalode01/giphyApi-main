<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trending Gifs</title>
    <style>
        body {
            background-color: lightgrey;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        button, input[type="text"], input[type="submit"] {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<h1>GIFINATOR</h1>

<button id="showTrending">Show Trending</button>
<form action="/trendingGiphy" method="get" style="display: none" id="trendingForm">
    <label for="trendingCount">Enter the number of gifs to display:</label>
    <input type="number" name="count" id="trendingCount" value="">
    <button type="submit">Search</button>
</form>
<button id="searchButton">Search for gifs</button>
<form action="/searchedGiphys" method="GET" style="display: none" id="searchForm">
    <label for="keyWord">Enter keyword to search GIFS:</label>
    <input class="input"
           id="keyWord"
           type="text"
           name="keyWord"
           maxlength="25"><br>
    <label for="amount">How many GIFS to display? (up to 25)</label>
    <input class="input"
           id="amount"
           type="number"
           name="amount"
           max="25"
           min="1"><br>
    <input class="searchButton"
           type="submit"
           value="Search">
    <input type="hidden"
           name="formSubmitted"
           value="true"><br>
</form>

{% if formSubmitted == true and collection is null %}
<p>No GIFS </p>
{% elseif formSubmitted == true %}
<p>{{ keyWord ? keyWord|capitalize : 'Trending' }} GIFS</p>
{% for gif in collection %}
<img src="{{ gif.url }}" alt="{{ gif.title }}">
{% endfor %}
{% endif %}

<script>
    const showTrendingButton = document.getElementById("showTrending");
    const trendingForm = document.getElementById("trendingForm");
    const searchButton = document.getElementById("searchButton");
    const searchForm = document.getElementById("searchForm");

    showTrendingButton.addEventListener("click", () => {
        showTrendingButton.style.display = "none";
        trendingForm.style.display = "block";
    });

    searchButton.addEventListener("click", () => {
        searchButton.style.display = "none";
        searchForm.style.display = "block";
    });
</script>

</body>
</html>