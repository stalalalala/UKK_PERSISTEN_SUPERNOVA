<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SERTIFIKAT</title>
    <style>
        @page { size: a4 landscape; margin: 0; }
        
        html, body { 
            margin: 0; padding: 0; 
            width: 29.7cm; height: 21cm; 
            font-family: 'Helvetica', Arial, sans-serif;
            background-color: #ffffff;
            overflow: hidden;
        }

        /* BINGKAI GANDA DENGAN GARIS LEBIH TEBAL */
        .outer-frame {
            width: 27cm;
            height: 16.5cm;
            margin: 1.2cm auto 0.2cm auto;
            border: 3.5pt solid #1e3a8a; /* Garis Luar Tebal */
            border-radius: 20px;
            padding: 10px; /* Jarak antar garis */
            box-sizing: border-box;
        }

        .inner-frame {
            border: 1.5pt solid #1e3a8a; /* Garis Dalam Sedikit Lebih Tipis */
            height: 100%;
            border-radius: 12px;
            padding: 35px 50px;
            text-align: center;
            box-sizing: border-box;
        }

        /* TYPOGRAPHY */
        .brand { 
            font-size: 11pt; font-weight: bold; color: #1e3a8a; 
            letter-spacing: 6px; text-transform: uppercase; margin-bottom: 15px;
        }
        
        .title { 
            font-size: 45pt; font-weight: 900; color: #1e3a8a; 
            margin: 0; letter-spacing: -1px;
        }
        
        .subtitle { 
            font-size: 12pt; color: #3b82f6; margin-top: 5px;
            font-weight: bold; letter-spacing: 2px;
        }

        .label { margin-top: 30px; font-size: 10pt; color: #64748b; font-style: italic; }
        
        .user-name { 
            font-size: 34pt; font-weight: bold; color: #1e3a8a; 
            margin: 10px 0; border-bottom: 3pt solid #3b82f6;
            display: inline-block; padding: 0 30px 5px 30px;
        }

        .desc { font-size: 10.5pt; color: #334155; margin: 15px 0; line-height: 1.5; }

        /* TABEL SKOR MODERN */
        .score-box { width: 100%; margin-top: 15px; border-collapse: collapse; }
        .card { 
            background: #f8fafc; border: 1.5pt solid #e2e8f0; 
            border-radius: 12px; padding: 12px;
        }

        .score-inner { width: 100%; border-collapse: collapse; }
        .score-inner td { padding: 6px 10px; font-size: 9pt; color: #1e3a8a; border-bottom: 1px solid #e2e8f0; }
        .score-inner tr:last-child td { border-bottom: none; }
        .cat-name { font-weight: 500; text-align: left; }
        .cat-score { font-weight: 800; text-align: right; font-size: 11pt; color: #3b82f6; }

        /* BADGE TOTAL */
        .total-container {
            margin-top: 25px;
            background: #1e3a8a;
            color: #ffffff;
            padding: 15px 40px;
            border-radius: 15px;
            display: inline-block;
        }

        .total-container table td { padding: 0 25px; text-align: center; }
        .num-big { font-size: 22pt; font-weight: 800; display: block; }
        .label-small { font-size: 7pt; font-weight: bold; opacity: 0.8; text-transform: uppercase; }

        /* FOOTER KANAN BAWAH */
        .footer-info {
            width: 27cm;
            margin: 0 auto;
            text-align: right;
            font-size: 7.5pt;
            color: #94a3b8;
            padding-right: 24px;
        }
    </style>
</head>
<body>

    <div class="outer-frame">
        <div class="inner-frame">
            <div class="brand">PERSISTEN</div>
            <h1 class="title">SERTIFIKAT</h1>
            <div class="subtitle">PENGHARGAAN HASIL EVALUASI</div>

            <div class="label">Sertifikat ini diberikan secara resmi kepada:</div>
            <div class="user-name">{{ $user->name }}</div>

            <div class="desc">
                Atas keberhasilan menyelesaikan <strong>{{ $tryout->nama_tryout }}</strong><br>
                dengan rincian penilaian skor sebagai berikut:
            </div>

            <table class="score-box">
                <tr>
                    <td style="width: 48%; padding: 0; vertical-align: top;">
                        <div class="card">
                            <table class="score-inner">
                                @foreach($categories->take(4) as $cat)
                                <tr>
                                    <td class="cat-name">{{ $cat->nama_kategori }}</td>
                                    <td class="cat-score">{{ number_format($cat->skor, 0) }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </td>
                    <td style="width: 4%;"></td>
                    <td style="width: 48%; padding: 0; vertical-align: top;">
                        <div class="card">
                            <table class="score-inner">
                                @foreach($categories->slice(4) as $cat)
                                <tr>
                                    <td class="cat-name">{{ $cat->nama_kategori }}</td>
                                    <td class="cat-score">{{ number_format($cat->skor, 0) }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="total-container">
                <table>
                    <tr>
                        <td>
                            <span class="label-small">Skor Total</span>
                            <span class="num-big">{{ number_format($skor_total, 0) }}</span>
                        </td>
                        <td style="border-left: 1px solid rgba(255,255,255,0.3);">
                            <span class="label-small">Rata-Rata</span>
                            <span class="num-big">{{ $categories->count() > 0 ? number_format($skor_total / $categories->count(), 1) : 0 }}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="footer-info">
        <strong>SERTIFIKAT DIGITAL PERSISTEN</strong><br>
        VERIFIKASI ID: {{ $user->id }}/{{ date('Ymd') }}
    </div>

</body>
</html>