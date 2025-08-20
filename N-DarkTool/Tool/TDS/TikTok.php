<?php

// Mã màu (PHP không hỗ trợ ANSI trực tiếp trên terminal, chỉ giữ lại để minh họa)
$den = "\033[1;90m";
$luc = "\033[1;32m";
$trang = "\033[1;37m";
$red = "\033[1;31m";
$vang = "\033[1;33m";
$tim = "\033[1;35m";
$lamd = "\033[1;34m";
$lam = "\033[1;36m";
$purple = "\033[1;35m";
$hong = "\033[1;95m";

// Đánh dấu bản quyền
$huong_pc = "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈";
$huong_dev = "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈";
$total = 0;
$may = (stripos(PHP_OS, 'linux') === 0) ? 'mb' : 'pc';

if (!function_exists('banner')) {
function banner() {
system('clear');
$banner = "
\033[1;33m███╗   ██╗    ██████╗     ████████╗ ██████╗  ██████╗ ██╗
\033[1;35m████╗  ██║    ██╔══██╗    ╚══██╔══╝██╔═══██╗██╔═══██╗██║
\033[1;36m██╔██╗ ██║    ██║  ██║       ██║   ██    ██║██║   ██║██║
\033[1;37m██║╚██╗██║    ██║  ██║       ██║   ██║   ██║██║   ██║██║
\033[1;32m██║ ╚████║    ██████╔╝       ██║   ╚██████╔╝╚██████╔╝███████╗
\033[1;31m╚═╝  ╚═══╝    ╚═════╝        ╚═╝    ╚═════╝  ╚═════╝ ╚══════╝\n
\033[1;97mTool By: \033[1;32mᰔᩚ𝐍-𝐃𝐚𝐫𝐤 𝐓𝐨𝐨𝐥 ♬            \033[1;97mPhiên Bản: \033[1;32m5.0    
\033[97m════════════════════════════════════════════════  
\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Tool\033[1;31m     : \033[1;97m☞ \033[1;31mGộp - Vip\033[1;33m♔ \033[1;97m🔫
\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Tik Tok\033[1;31m  : \033[1;33mhttps:\033[1;32m//www.tiktok.com\033[1;31m/mᰔᩚ𝐍-𝐃𝐚𝐫𝐤 𝐓𝐨𝐨𝐥 ♬
\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;97m Zalo: \033[1;35m09XXXXXXX☜
\033[97m════════════════════════════════════════════════
\033[1;97m[\033[1;91m❣\033[1;97m]\033[1;91m Lưu ý\033[1;31m    : \033[1;97m☞ \033[1;32mTool Sử Dụng ALL Thiết Bị\033[1;31m♔ \033[1;97m☜
\033[97m════════════════════════════════════════════════
";
foreach (str_split($banner) as $X) {
    echo $X;
    usleep(1250);
}
}
}

function bongoc($so) {
    for ($i = 0; $i < $so; $i++) {
        echo "────";
    }
    echo "\n";
}

class TraoDoiSub_Api {
    private $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function main_TDS() {
        try {
            $response = file_get_contents("https://traodoisub.com/api/?fields=profile&access_token=" . $this->token);
            $main = json_decode($response, true);
            return isset($main['data']) ? $main['data'] : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function run($user) {
        try {
            $response = file_get_contents("https://traodoisub.com/api/?fields=tiktok_run&id=$user&access_token=" . $this->token);
            $run = json_decode($response, true);
            return isset($run['data']) ? $run['data'] : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function get_job($type) {
        try {
            $response = file_get_contents("https://traodoisub.com/api/?fields=$type&access_token=" . $this->token);
            return $response;
        } catch (Exception $e) {
            return false;
        }
    }

    public function cache($id, $type) {
        try {
            $response = file_get_contents("https://traodoisub.com/api/coin/?type=$type&id=$id&access_token=" . $this->token);
            $cache = json_decode($response, true);
            return isset($cache['cache']) ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function nhan_xu($id, $type) {
        global $total, $red, $luc, $lam, $vang;
        try {
            $response = file_get_contents("https://traodoisub.com/api/coin/?type=$type&id=$id&access_token=" . $this->token);
            $nhan = json_decode($response, true);
            if (isset($nhan['data'])) {
                $xu = $nhan['data']['xu'];
                $msg = $nhan['data']['msg'];
                $job = $nhan['data']['job_success'];
                $xuthem = $nhan['data']['xu_them'];
                $total += $xuthem;
                bongoc(14);
                echo "$lam Nhận Thành Công $job Nhiệm Vụ $red |$luc $msg $red |$luc TOTAL $vang $total$luc Xu $red | $vang $xu \n";
                bongoc(14);
                return ($job == 0) ? 0 : true;
            } else {
                if (isset($nhan['code']) && $nhan['code'] == 'error') {
                    $hien = $nhan['msg'];
                    echo "$red $hien\r";
                    usleep(2000000); // 2 giây
                    echo str_repeat(" ", strlen($hien)) . "\r";
                } else {
                    echo "$red Nhận Xu Thất Bại !\r";
                    usleep(2000000);
                    echo str_repeat(" ", 50) . "\r";
                }
                return false;
            }
        } catch (Exception $e) {
            echo "$red Nhận Xu Thất Bại !\r";
            usleep(2000000);
            echo str_repeat(" ", 50) . "\r";
            return false;
        }
    }
}

function delay($dl) {
    $colors = [
        "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;37mᰔᩚ\033[1;36m𝐍\033[1;35m-\033[1;32m𝐃\033[1;31ma\033[1;34mr\033[1;33mk \033[1;36m𝐓\033[1;37mo\033[1;31mo\033[1;32ml \033[1;35m♬ \033[1;36m🍉",
        "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;34mᰔᩚ\033[1;31m𝐍\033[1;37m-\033[1;36m𝐃\033[1;32ma\033[1;35mr\033[1;37mk \033[1;33m𝐓\033[1;32mo\033[1;36mo\033[1;37ml \033[1;34m♬ \033[1;36m🍉",
        "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;31mᰔᩚ\033[1;37m𝐍\033[1;36m-\033[1;33m𝐃\033[1;35ma\033[1;32mr\033[1;34mk \033[1;31m𝐓\033[1;33mo\033[1;35mo\033[1;37ml \033[1;33m♬ \033[1;36m🍉",
        "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;32mᰔᩚ\033[1;33m𝐍\033[1;34m-\033[1;35m𝐃\033[1;36ma\033[1;37mr\033[1;36mk \033[1;31m𝐓\033[1;34mo\033[1;33mo\033[1;32ml \033[1;31m♬ \033[1;36m🍉",
        "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;37mᰔᩚ\033[1;34m𝐍\033[1;35m-\033[1;36m𝐃\033[1;32ma\033[1;33mr\033[1;31mk \033[1;37m𝐓\033[1;31mo\033[1;37mo\033[1;34ml \033[1;37m♬ \033[1;36m🍉",
        "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;34mᰔᩚ\033[1;33m𝐍\033[1;37m-\033[1;35m𝐃\033[1;31ma\033[1;36mr\033[1;32mk \033[1;36m𝐓\033[1;32mo\033[1;36mo\033[1;37ml \033[1;36m♬ \033[1;36m🍉",
        "\033[1;97m[\033[1;91m❣\033[1;97m] \033[1;36m✈ \033[1;36mᰔᩚ\033[1;35m𝐍\033[1;31m-\033[1;34m𝐃\033[1;37ma\033[1;35mr\033[1;32mk \033[1;33m𝐓\033[1;34mo\033[1;31mo\033[1;36ml \033[1;33m♬ \033[1;36m🍉"
    ];
    
    for ($remaining_time = $dl; $remaining_time >= 0; $remaining_time--) {
        foreach ($colors as $color) {
            echo "\r{$color}|{$remaining_time}| \033[1;31m";
            usleep(150000);
        }
    }
    
    echo "\r                          \r";
    echo "\033[1;35mĐang Nhận Tiền         \r";
}

function chuyen($link, $may) {
    if ($may == 'mb') {
        exec("termux-open-url $link");
    } else {
        exec("termux-open-url $link");
    }
}

function main_TDS() {
    global $huong_pc, $luc, $vang, $trang, $red, $lam, $total, $may;

    $dem = 0;
    banner();

    while (true) {
        if (file_exists('configtds.txt')) {
            $token = file_get_contents('configtds.txt');
            $tds = new TraoDoiSub_Api($token);
            $data = $tds->main_TDS();
            try {
                echo "$huong_pc$luc Nhập$vang [$trang'1'$vang]$luc Giữ Lại Tài Khoản $vang " . $data['user'] . "\n";
                echo "$huong_pc$luc Nhập$vang [$trang'2'$vang]$luc Nhập Access_Token TDS Mới\n";
                echo "$huong_pc$luc Vui lòng chọn: ";
                $chon = trim(fgets(STDIN));
                if ($chon == '2') {
                    unlink('configtds.txt');
                } elseif ($chon == '1') {
                    // pass
                } else {
                    echo "$red Lựa chọn không xác định !!!\n";
                    bongoc(14);
                    continue;
                }
            } catch (Exception $e) {
                unlink('configtds.txt');
            }
        }
        if (!file_exists('configtds.txt')) {
            echo "$huong_pc$luc Nhập Access_Token TDS: $vang ";
            $token = trim(fgets(STDIN));
            file_put_contents('configtds.txt', $token);
        }
        $token = file_get_contents('configtds.txt');
        $tds = new TraoDoiSub_Api($token);
        $data = $tds->main_TDS();
        try {
            $xu = $data['xu'];
            $xudie = $data['xudie'];
            $user = $data['user'];
            echo "$lam Đăng Nhập Thành Công \n";
            break;
        } catch (Exception $e) {
            echo "$red Access Token Không Hợp Lệ! Xin Thử Lại \n";
            unlink('configtds.txt');
            continue;
        }
    }
    bongoc(14);

    banner();
    echo "$huong_pc$luc Tên Tài Khoản: $vang $user \n";
    echo "$huong_pc$luc Xu Hiện Tại: $vang $xu \n";
    echo "$huong_pc$luc Xu Bị Phạt: $vang $xudie \n";

    while (true) {
        $ntool = 0;
        bongoc(14);
        echo "$huong_pc$luc Nhập$red [$vang'1'$red]$luc Để Chạy Nhiệm Vụ Tim\n";
        echo "$huong_pc$luc Nhập$red [$vang'2'$red]$luc Để Chạy Nhiệm Vụ Follow\n";
        echo "$huong_pc$luc Nhập$red [$vang'3'$red]$luc Để Chạy Nhiệm Vụ Follow Tiktok Now\n";
        echo "$huong_pc$luc Nhập Số Để Chạy Nhiệm Vụ:$vang ";
        $nhiem_vu = trim(fgets(STDIN));
        echo "$huong_pc$luc Nhập Delay:$vang ";
        $dl = (int)trim(fgets(STDIN));

        while (true) {
            if ($ntool == 2) break;
            $ntool = 0;
            bongoc(14);
            echo "$huong_pc$luc Sau Bao Nhiêu Nhiệm Vụ Thì Nhận Xu:$vang ";
            $nv_nhan = (int)trim(fgets(STDIN));
            if ($nv_nhan < 8) {
                echo "$red Trên 8 Nhiệm Vụ Mới Được Nhận Tiền!\n";
                continue;
            }
            if ($nv_nhan > 15) {
                echo "$red Nhận Xu Dưới 15 Nhiệm Vụ Để Tránh Lỗi\n";
                continue;
            }
            echo "$huong_pc$luc Nhập User Name Tik Tok Cần Cấu Hình: $vang ";
            $user_cau_hinh = trim(fgets(STDIN));
            $cau_hinh = $tds->run($user_cau_hinh);
            if ($cau_hinh !== false) {
                $user = $cau_hinh['uniqueID'];
                $id_acc = $cau_hinh['id'];
                bongoc(14);
                echo "$luc Đang Cấu Hình ID: $vang $id_acc $red |$luc User: $vang $user $red |\n";
                bongoc(14);
            } else {
                echo "$red Cấu Hinh Thất Bại User: $vang $user_cau_hinh \n";
                continue;
            }
            echo "\033[1;36m|STT\033[1;97m| \033[1;33mThời gian ┊ \033[1;32mStatus | \033[1;31mType Job | \033[1;32mID Acc | \033[1;32mXu |\n";

            while (true) {
                if ($ntool == 1 || $ntool == 2) break;
                if (strpos($nhiem_vu, '1') !== false) {
                    $listlike = $tds->get_job('tiktok_like');
                    if ($listlike === false) {
                        echo "$red Không Get Được Nhiệm Vụ Like              \r";
                        usleep(2000000);
                        echo str_repeat(" ", 50) . "\r";
                    } elseif (strpos($listlike, 'error') !== false) {
                        $listlike_json = json_decode($listlike, true);
                        if ($listlike_json['error'] == 'Thao tác quá nhanh vui lòng chậm lại') {
                            $coun = $listlike_json['countdown'];
                            echo "$red Đang Get Nhiệm Vụ Like, COUNTDOWN: " . round($coun, 3) . " \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        } elseif ($listlike_json['error'] == 'Vui lòng ấn NHẬN TẤT CẢ rồi sau đó tiếp tục làm nhiệm vụ để tránh lỗi!') {
                            $tds->nhan_xu('TIKTOK_LIKE_API', 'TIKTOK_LIKE');
                        } else {
                            echo "$red " . $listlike_json['error'] . "\r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        }
                    } else {
                        $listlike = json_decode($listlike, true)['data'] ?? [];
                        if (count($listlike) == 0) {
                            echo "$red Hết Nhiệm Vụ Like                             \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        } else {
                            echo "$luc Tìm Thấy $vang " . count($listlike) . "$luc Nhiệm Vụ Like                       \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                            foreach ($listlike as $i) {
                                $id = $i['id'];
                                $link = $i['link'];
                                chuyen($link, $may);
                                $cache = $tds->cache($id, 'TIKTOK_LIKE_CACHE');
                                if ($cache !== true) {
                                    $tg = date('H:i:s');
                                    $hien = "[$vang [$red X$vang] $red | $lam $tg $red | $vang TIM $red | $trang $id $red |";
                                    echo "$hien\r";
                                    usleep(1000000);
                                    echo str_repeat(" ", 100) . "\r";
                                } else {
                                    $dem++;
                                    $tg = date('H:i:s');
                                    $chuoi = (
                                        "\033[1;31m| \033[1;36m{$dem}\033[1;31m\033[1;97m | " .
                                        "\033[1;33m{$tg}\033[1;31m\033[1;97m  | " .
                                        "\033[1;32mSuccess\033[1;31m\033[1;97m | " .
                                        "\033[1;31mTIM\033[1;31m\033[1;32m\033[1;32m\033[1;97m |" .
                                        "\033[1;32m Ẩn ID\033[1;97m | \033[1;32m+1400xu \033[1;97m| "
                                    );
                                    echo "$chuoi\n";
                                    delay($dl);
                                    if ($dem % $nv_nhan == 0) {
                                        $nhan = $tds->nhan_xu('TIKTOK_LIKE_API', 'TIKTOK_LIKE');
                                        if ($nhan == 0) {
                                            echo "$luc Nhận Xu Thất Bại Acc Tiktok Của Bạn Ổn Chứ \n";
                                            echo "$huong_pc$luc Nhập $red [$vang 1$red]$luc Để Thay Nhiệm Vụ \n";
                                            echo "$huong_pc$luc Nhập $red [$vang 2$red]$luc Thay Acc Tiktok \n";
                                            echo "$huong_pc$luc Nhấn $red [$vang Enter$red]$luc Để Tiếp Tục\n";
                                            echo "$huong_pc$luc Nhập $trang ===>: $vang ";
                                            $chon = trim(fgets(STDIN));
                                            if ($chon == '1') {
                                                $ntool = 2;
                                                break;
                                            } elseif ($chon == '2') {
                                                $ntool = 1;
                                                break;
                                            }
                                            bongoc(14);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if ($ntool == 1 || $ntool == 2) break;
                if (strpos($nhiem_vu, '2') !== false) {
                    $listfollow = $tds->get_job('tiktok_follow');
                    if ($listfollow === false) {
                        echo "$red Không Get Được Nhiệm Vụ Follow              \r";
                        usleep(2000000);
                        echo str_repeat(" ", 50) . "\r";
                    } elseif (strpos($listfollow, 'error') !== false) {
                        $listfollow_json = json_decode($listfollow, true);
                        if ($listfollow_json['error'] == 'Thao tác quá nhanh vui lòng chậm lại') {
                            $coun = $listfollow_json['countdown'];
                            echo "$red Đang Get Nhiệm Vụ Follow, COUNTDOWN: " . round($coun, 3) . " \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        } elseif ($listfollow_json['error'] == 'Vui lòng ấn NHẬN TẤT CẢ rồi sau đó tiếp tục làm nhiệm vụ để tránh lỗi!') {
                            $tds->nhan_xu('TIKTOK_FOLLOW_API', 'TIKTOK_FOLLOW');
                        } else {
                            echo "$red " . $listfollow_json['error'] . "\r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        }
                    } else {
                        $listfollow = json_decode($listfollow, true)['data'] ?? [];
                        if (count($listfollow) == 0) {
                            echo "$red Hết Nhiệm Vụ Follow                             \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        } else {
                            echo "$luc Tìm Thấy $vang " . count($listfollow) . "$luc Nhiệm Vụ Follow                       \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                            foreach ($listfollow as $i) {
                                $id = $i['id'];
                                $link = $i['link'];
                                chuyen($link, $may);
                                $cache = $tds->cache($id, 'TIKTOK_FOLLOW_CACHE');
                                if ($cache !== true) {
                                    $tg = date('H:i:s');
                                    $hien = "[$vang [$red X$vang] $red | $lam $tg $red | $vang FOLLOW $red | $trang $id $red |";
                                    echo "$hien\r";
                                    usleep(1000000);
                                    echo str_repeat(" ", 100) . "\r";
                                } else {
                                    $dem++;
                                    $tg = date('H:i:s');
                                    $chuoi = (
                                        "\033[1;31m| \033[1;36m{$dem}\033[1;31m\033[1;97m | " .
                                        "\033[1;33m{$tg}\033[1;31m\033[1;97m  | " .
                                        "\033[1;32mSuccess\033[1;31m\033[1;97m | " .
                                        "\033[1;31mFOLLOW\033[1;31m\033[1;32m\033[1;32m\033[1;97m |" .
                                        "\033[1;32m Ẩn ID\033[1;97m | \033[1;32m+1400xu \033[1;97m| "
                                    );
                                    echo "$chuoi\n";
                                    delay($dl);
                                    if ($dem % $nv_nhan == 0) {
                                        $nhan = $tds->nhan_xu('TIKTOK_FOLLOW_API', 'TIKTOK_FOLLOW');
                                        if ($nhan == 0) {
                                            echo "$luc Nhận Xu Thất Bại Acc Tiktok Của Bạn Ổn Chứ \n";
                                            echo "$huong_pc$luc Nhập $red [$vang 1$red]$luc Để Thay Nhiệm Vụ \n";
                                            echo "$huong_pc$luc Nhập $red [$vang 2$red]$luc Thay Acc Tiktok \n";
                                            echo "$huong_pc$luc Nhấn $red [$vang Enter$red]$luc Để Tiếp Tục\n";
                                            echo "$huong_pc$luc Nhập $trang ===>: $vang ";
                                            $chon = trim(fgets(STDIN));
                                            if ($chon == '1') {
                                                $ntool = 2;
                                                break;
                                            } elseif ($chon == '2') {
                                                $ntool = 1;
                                                break;
                                            }
                                            bongoc(14);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if ($ntool == 1 || $ntool == 2) break;
                if (strpos($nhiem_vu, '3') !== false) {
                    $listfollow = $tds->get_job('tiktok_follow');
                    if ($listfollow === false) {
                        echo "$red Không Get Được Nhiệm Vụ Follow              \r";
                        usleep(2000000);
                        echo str_repeat(" ", 50) . "\r";
                    } elseif (strpos($listfollow, 'error') !== false) {
                        $listfollow_json = json_decode($listfollow, true);
                        if ($listfollow_json['error'] == 'Thao tác quá nhanh vui lòng chậm lại') {
                            $coun = $listfollow_json['countdown'];
                            echo "$red Đang Get Nhiệm Vụ Follow, COUNTDOWN: " . round($coun, 3) . " \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        } elseif ($listfollow_json['error'] == 'Vui lòng ấn NHẬN TẤT CẢ rồi sau đó tiếp tục làm nhiệm vụ để tránh lỗi!') {
                            $tds->nhan_xu('TIKTOK_FOLLOW_API', 'TIKTOK_FOLLOW');
                        } else {
                            echo "$red " . $listfollow_json['error'] . "\r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        }
                    } else {
                        $listfollow = json_decode($listfollow, true)['data'] ?? [];
                        if (count($listfollow) == 0) {
                            echo "$red Hết Nhiệm Vụ Follow                             \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                        } else {
                            echo "$luc Tìm Thấy $vang " . count($listfollow) . "$luc Nhiệm Vụ Follow                       \r";
                            usleep(2000000);
                            echo str_repeat(" ", 50) . "\r";
                            foreach ($listfollow as $i) {
                                $id = $i['id'];
                                $uid = explode('_', $id)[0];
                                $link = $i['link'];
                                $que = $i['uniqueID'];
                                if ($may == 'mb') {
                                    chuyen("tiktoknow://user/profile?user_id=$uid", $may);
                                } else {
                                    chuyen("https://now.tiktok.com/@$que", $may);
                                }
                                $cache = $tds->cache($id, 'TIKTOK_FOLLOW_CACHE');
                                if ($cache !== true) {
                                    $tg = date('H:i:s');
                                    $hien = "[$vang [$red X$vang] $red | $lam $tg $red | $vang FOLLOW_TIKTOK_NOW $red | $trang $id $red |";
                                    echo "$hien\r";
                                    usleep(1000000);
                                    echo str_repeat(" ", 100) . "\r";
                                } else {
                                    $dem++;
                                    $tg = date('H:i:s');
                                    $chuoi = (
                                        "\033[1;31m| \033[1;36m{$dem}\033[1;31m\033[1;97m | " .
                                        "\033[1;33m{$tg}\033[1;31m\033[1;97m  | " .
                                        "\033[1;32mSuccess\033[1;31m\033[1;97m | " .
                                        "\033[1;31mTIM\033[1;31m\033[1;32m\033[1;32m\033[1;97m |" .
                                        "\033[1;32m Ẩn ID\033[1;97m | \033[1;32m+1400xu \033[1;97m| "
                                    );
                                    echo "$chuoi\n";
                                    delay($dl);
                                    if ($dem % $nv_nhan == 0) {
                                        $nhan = $tds->nhan_xu('TIKTOK_FOLLOW_API', 'TIKTOK_FOLLOW');
                                        if ($nhan == 0) {
                                            echo "$luc Nhận Xu Thất Bại Acc Tiktok Của Bạn Ổn Chứ \n";
                                            echo "$huong_pc$luc Nhập$red [$vang'1'$red]$luc Để Thay Nhiệm Vụ \n";
                                            echo "$huong_pc$luc Nhập$red [$vang'2'$red]$luc Thay Acc Tiktok \n";
                                            echo "$huong_pc$luc Nhấn$red [$vang'Enter'$red]$luc Để Tiếp Tục\n";
                                            echo "$huong_pc$luc Nhập $trang ===>: $vang ";
                                            $chon = trim(fgets(STDIN));
                                            if ($chon == '1') {
                                                $ntool = 2;
                                                break;
                                            } elseif ($chon == '2') {
                                                $ntool = 1;
                                                break;
                                            }
                                            bongoc(14);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

main_TDS();
?>
