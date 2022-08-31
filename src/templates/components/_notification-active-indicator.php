<?php

    $status = mt_rand(0, 1) ? 'Active' : 'Inactive';
?>

<small class="sa-d-flex-center sa-ms-4 sa-notification-status <?php echo strtolower($status); ?>">
    <svg class="sa-me-1 sa-active-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="22" width="22"><path d="m10.6 16.6 7.05-7.05-1.4-1.4-5.65 5.65-2.85-2.85-1.4 1.4ZM12 22q-2.075 0-3.9-.788-1.825-.787-3.175-2.137-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175 1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138 1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175-1.35 1.35-3.175 2.137Q14.075 22 12 22Z"/></svg>
    <svg class="sa-me-1 sa-inactive-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" height="22" width="22"><path d="M20 36.667q-3.417 0-6.458-1.313-3.042-1.312-5.313-3.583t-3.583-5.313Q3.333 23.417 3.333 20q0-3.458 1.313-6.5 1.312-3.042 3.583-5.292t5.313-3.562Q16.583 3.333 20 3.333q3.458 0 6.5 1.313 3.042 1.312 5.292 3.562t3.562 5.292q1.313 3.042 1.313 6.5 0 3.417-1.313 6.458-1.312 3.042-3.562 5.313T26.5 35.354q-3.042 1.313-6.5 1.313Z"/></svg>

    <span class="sa-notification-status-text"><?php echo $status; ?></span>
</small>