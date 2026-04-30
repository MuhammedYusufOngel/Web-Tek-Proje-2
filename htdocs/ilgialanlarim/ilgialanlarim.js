const data = null;

const xhr = new XMLHttpRequest();
xhr.withCredentials = true;

let title = []
let link = [] 
let imageUrl = []
let pubDate = []
let category = []

function formatRelativeTime(dateString) {
    const targetDate = new Date(dateString);
    const now = new Date();
    
    // Aradaki farkı saniye cinsinden alalım
    const secondsDiff = Math.floor((targetDate - now) / 1000);

    // Zaman birimleri ve saniye karşılıkları
    const units = [
        { unit: 'year', seconds: 31536000 },
        { unit: 'month', seconds: 2592000 },
        { unit: 'day', seconds: 86400 },
        { unit: 'hour', seconds: 3600 },
        { unit: 'minute', seconds: 60 },
        { unit: 'second', seconds: 1 }
    ];

    // Yerleşik JS nesnesini oluştur (Türkçe dil desteğiyle)
    const rtf = new Intl.RelativeTimeFormat('tr', { numeric: 'always' });

    for (const { unit, seconds } of units) {
        if (Math.abs(secondsDiff) >= seconds || unit === 'second') {
            const value = Math.round(secondsDiff / seconds);
            return rtf.format(value, unit);
        }
    }
}

xhr.addEventListener('readystatechange', function () {
	if (this.readyState === this.DONE) {
		const json = JSON.parse(this.responseText);

		if(Array.isArray(json.MotoGPNews)){
			json.MotoGPNews.forEach(item => {
				document.getElementById("haberler").innerHTML += `
					<div class="haber">
						<h2>${item.title}</h2>
						<img src="${item.imageURL}" alt="${item.title}" style="width:50%; height:auto;">
						<p>${formatRelativeTime(item.pubDate)}</p>
						<a href="${item.link}" target="_blank" class="btn-modern">Habere Git</a>
					</div>
				`;
			})
		}
	}
});

xhr.open('GET', 'https://motogp-news.p.rapidapi.com/motogpnews');
xhr.setRequestHeader('x-rapidapi-key', '54ea8c4953msh483f56f5517c49bp10082ejsnd7dec93d9097');
xhr.setRequestHeader('x-rapidapi-host', 'motogp-news.p.rapidapi.com');
xhr.setRequestHeader('Content-Type', 'application/json');

xhr.send(data);