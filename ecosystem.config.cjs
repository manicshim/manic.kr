module.exports = {
  apps: [{
    name: 'manic-home',
    script: 'dist/main.js',
    cwd: __dirname,
    instances: 1,
    exec_mode: 'fork',
    wait_ready: true,
    listen_timeout: 10000,
    kill_timeout: 5000,
    merge_logs: true,
    max_memory_restart: '250M',
    env_production: { NODE_ENV: 'production', PORT: 3100 },
  }],
};
