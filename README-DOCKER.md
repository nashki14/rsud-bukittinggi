# Deployment Guide - RSUD Bukittinggi Web

## Struktur file yang ditambahkan
```
rsud-bukittinggi/
├── docker/
│   ├── nginx.conf       ← konfigurasi web server
│   └── start.sh         ← startup script container
├── .env.docker          ← env khusus production Docker
├── docker-compose.yml   ← definisi semua service
├── Dockerfile           ← instruksi build image
└── README-DOCKER.md     ← file ini
```

## Langkah Deploy

### 1. Copy file-file ini ke folder project
Salin semua file di sini ke root folder `rsud-bukittinggi/`

### 2. Push ke GitHub
```bash
git add Dockerfile docker/ .env.docker docker-compose.yml
git commit -m "add docker deployment files"
git push
```

### 3. Di server (SSH ke 10.1.1.127)
```bash
cd /opt
git clone https://github.com/nashki14/rsud-bukittinggi.git rsud-web
cd rsud-web

# Build image (5-10 menit pertama kali)
docker build -t rsud-web:latest .
```

### 4. Deploy via Portainer
- Buka Portainer → Stacks → Add Stack
- Nama stack: rsud-web
- Pilih "Upload" → upload file docker-compose.yml
- Klik "Deploy the stack"

### 5. Akses aplikasi
http://10.1.1.127:8086

## Troubleshooting

### Lihat log container
```bash
docker logs rsud-web
docker logs rsud-db
```

### Masuk ke dalam container
```bash
docker exec -it rsud-web sh
```

### Rebuild setelah ada perubahan kode
```bash
cd /opt/rsud-web
git pull
docker build -t rsud-web:latest .
# Lalu restart stack di Portainer
```
