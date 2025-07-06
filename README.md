# Library.com Vulnerable Box (SQLite Edition)

A beginner-to-medium difficulty web security training box. Deliberately vulnerable PHP/SQLite app—no MySQL, no WordPress.

## Setup

1. Clone this repo.
2. Ensure Docker is installed.
3. Add to your hosts file:
   ```
   127.0.0.1 library.com
   ```
4. In this directory, run:
   ```
   docker-compose up -d
   ```
5. Visit http://library.com:8080

## Walkthrough

### Phase 1: Login → User Flag
- Login as `admin`/`admin123` or `normal`/`library123`
- If logged in as `normal`, the dashboard will show the user flag from `/home/library-user/user.txt`

### Phase 2: SQLi → Upload → LFI → Netcat Shell → SUID → Root Flag
- Exploit SQL injection in `search.php` (still vulnerable)
- Upload a PHP shell via `upload.php` (no server-side checks)
- Trigger LFI in `download.php` to execute your shell
- Use netcat for a reverse shell
- Find and exploit `/usr/bin/magic_backup` (SUID root) to escalate
- Read `/root/root.txt` for the root flag

## Structure

- `app/`: PHP source (index.php, dashboard.php, search.php, upload.php, download.php, shell.php)
- `db/library.db`: SQLite database (pre-seeded, no MySQL needed)
- `tools/magic_backup.c`: SUID backup tool source
- `root/root.txt`: Root flag
- `Dockerfile`, `docker-compose.yml`: Container setup

**For educational use only.**
