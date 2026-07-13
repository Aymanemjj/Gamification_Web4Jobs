const http = require('http');
const PORT = 4000;

const users = [
  { firstName: "John", lastName: "Doe", email: "admin@example.com", password: "password123", role: "super_admin" },
  { firstName: "Jane", lastName: "Smith", email: "learner1@example.com", password: "password123", role: "learner" },
  { firstName: "Alex", lastName: "Jones", email: "learner2@example.com", password: "password123", role: "learner" },
  { firstName: "Morgan", lastName: "Brown", email: "manager@example.com", password: "password123", role: "center_manager" },
  { firstName: "Taylor", lastName: "Green", email: "team@example.com", password: "password123", role: "pedagogical_team" }
];

const server = http.createServer((req, res) => {
  res.setHeader('Content-Type', 'application/json');

  if (req.method === 'POST' && req.url === '/api/login') {
    let body = '';
    req.on('data', chunk => { body += chunk.toString(); });
    req.on('end', () => {
      try {
        const { email, password } = JSON.parse(body);
        const user = users.find(u => u.email === email && u.password === password);

        if (user) {
          res.writeHead(200);
          res.end(JSON.stringify({
            success: true,
            data: { firstname: user.firstName, lastname: user.lastName, email: user.email, role: user.role }
          }));
        } else {
          res.writeHead(401);
          res.end(JSON.stringify({ success: false, message: "Invalid credentials" }));
        }
      } catch (e) {
        res.writeHead(400);
        res.end(JSON.stringify({ success: false, message: "Bad Request" }));
      }
    });
  } else {
    res.writeHead(404);
    res.end(JSON.stringify({ success: false, message: "Not Found" }));
  }
});

//server.listen(PORT, () => console.log(`Mock Auth system online on port ${PORT}`));
server.listen(PORT, '0.0.0.0', () => {
  console.log(`External Auth Mock API running at http://0.0.0.0:${PORT}`);
  console.log('Ready to receive authentication requests from Laravel Docker container...');
});
