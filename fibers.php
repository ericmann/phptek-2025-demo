<?php
$fiber = new Fiber(function(): void {
  echo "Fiber says: Started\n";
  $data = Fiber::suspend("paused");
  echo "Fiber resumed with: $data\n";
});

echo "Main: before start\n";
$value = $fiber->start(); // Runs until suspend
echo "Main: fiber suspended, returned: $value\n";
$fiber->resume("resume-data"); // Resumes fiber
