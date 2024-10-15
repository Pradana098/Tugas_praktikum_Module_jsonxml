const axios = require('axios'); // Import axios untuk mengambil data dari API
const builder = require('xmlbuilder'); // Import xmlbuilder untuk membangun XML

// URL API JSON (ganti dengan URL API JSON yang sesuai)
const apiUrl = 'http://localhost/Tugas_Praktikum_Module_jsonxml/book_json.php'; // Misalkan ini adalah URL API JSON kamu

// Fungsi untuk mengambil data JSON dan mengonversinya menjadi XML
async function fetchAndConvertToXML() {
    try {
        // Mengambil data dari API JSON menggunakan axios
        const response = await axios.get(apiUrl);
        const data = response.data;

        // Mulai membangun struktur XML menggunakan xmlbuilder
        const xml = builder.create('books'); // Elemen root 'books'

        // Looping data JSON dan konversi menjadi XML
        data.forEach(book => {
            const bookElement = xml.ele('book'); // Elemen 'book' untuk setiap item
            bookElement.ele('id', book.id);
            bookElement.ele('title', book.title);
            bookElement.ele('author', book.author);
            bookElement.ele('year', book.year);
        });

        // Menghasilkan XML dalam format string
        const xmlString = xml.end({ pretty: true });

        // Output XML yang sudah dihasilkan
        console.log(xmlString);
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Jalankan fungsi untuk mengambil data JSON dan mengonversinya menjadi XML
fetchAndConvertToXML();
