<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Prescription') }} - {{ $client->name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 40px;
            color: #1f2937;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 800px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        /* Shine effect */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: 0.5s;
            pointer-events: none;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            color: #4A70A9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .client-info h1 {
            font-size: 20px;
            margin: 0 0 5px 0;
            color: #111827;
        }

        .client-info p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .eye-card {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .eye-title {
            font-size: 18px;
            font-weight: 700;
            color: #4A70A9;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .param {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .param label {
            color: #6b7280;
            font-weight: 500;
        }

        .param span {
            font-weight: 700;
            color: #111827;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
        }

        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #4A70A9;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(74, 112, 169, 0.4);
            transition: all 0.2s;
        }

        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px -1px rgba(74, 112, 169, 0.5);
        }

        @media print {
            body {
                background: white;
                padding: 0;
                display: block;
            }

            .card {
                box-shadow: none;
                border: none;
                backdrop-filter: none;
                max-width: 100%;
                padding: 20px;
            }

            .print-btn {
                display: none;
            }

            .eye-card {
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="header">
            <div class="logo">Connek</div>
            <div class="client-info">
                <h1>{{ $client->name }}</h1>
                <p>#Ref: {{ $client->id }} • {{ $client->created_at->format('d M Y') }}</p>
            </div>
        </div>

        @php
            $details = json_decode($client->prescription_details);
            $od = $details->sph_od ?? null;
            $og = $details->sph_og ?? null;
        @endphp

        <div class="grid">
            <!-- OD -->
            <div class="eye-card">
                <div class="eye-title">OD (Droit)</div>
                <div class="param"><label>SPH</label> <span>{{ $details->sph_od ?? '-' }}</span></div>
                <div class="param"><label>CYL</label> <span>{{ $details->cyl_od ?? '-' }}</span></div>
                <div class="param"><label>AXE</label> <span>{{ $details->axis_od ?? '-' }}</span></div>
                <div class="param"><label>ADD</label> <span>{{ $details->add_od ?? '-' }}</span></div>
            </div>

            <!-- OG -->
            <div class="eye-card">
                <div class="eye-title">OG (Gauche)</div>
                <div class="param"><label>SPH</label> <span>{{ $details->sph_og ?? '-' }}</span></div>
                <div class="param"><label>CYL</label> <span>{{ $details->cyl_og ?? '-' }}</span></div>
                <div class="param"><label>AXE</label> <span>{{ $details->axis_og ?? '-' }}</span></div>
                <div class="param"><label>ADD</label> <span>{{ $details->add_og ?? '-' }}</span></div>
            </div>
        </div>

        <div style="text-align: center; margin-bottom: 20px;">
            <strong>PD (Distance Pupillaire):</strong> {{ $details->pd ?? '-' }} mm
        </div>

        <div class="footer">
            <p>{{ __('This document is a summary of the prescription.') }}</p>
            <p>Connek Optical Systems • 2026</p>
        </div>
    </div>

    <button class="print-btn" onclick="window.print()">🖨 {{ __('Print') }}</button>

</body>

</html>