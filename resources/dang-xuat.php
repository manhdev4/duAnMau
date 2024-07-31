<?php
session_start();
session_destroy();
header('location: /g');
die('<script>location.href="/g"</script>');