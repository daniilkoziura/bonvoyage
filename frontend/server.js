const express = require('express');
const path = require('path');
const app = express();

app.disable('etag');

const root = path.join(__dirname, 'build');
app.use(express.static(root));

app.get('*', (req, res) => {
    res.sendFile('index.html', {root});
});

app.listen(process.env.PORT_EXTERNAL || 3000);
