<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">Track your application progress and discover new opportunities.</p>
        </div>
    </x-slot>

    @php
        $latestApplication = $recentUserApplications->first();
        $distinctStatuses = count($statusCounts ?? []);
        $currentMonthApplications = $trendChartData['data'][count($trendChartData['data']) - 1] ?? 0;
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">Applications submitted</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $appStats['applied'] ?? 0 }}</p>
                    <p class="mt-3 text-xs font-medium text-emerald-600 flex items-center gap-2">
                        <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                        {{ $currentMonthApplications }} submitted this month
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">Active scholarships</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $appStats['scholarships'] ?? 0 }}</p>
                    <p class="mt-3 text-xs text-gray-500">Opportunities currently open for applications.</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">Statuses tracked</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $distinctStatuses }}</p>
                    <p class="mt-3 text-xs text-gray-500">Breakdown used in the status chart below.</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm font-medium text-gray-500">Last submission</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">
                        {{ optional($latestApplication?->created_at)->format('M j, Y') ?? '—' }}
                    </p>
                    <p class="mt-3 text-xs text-gray-500">
                        {{ $latestApplication?->scholarship?->title ?? 'No applications submitted yet.' }}
                    </p>
                </div>
            </section>

            <section class="grid gap-6 lg:grid-cols-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Application status</h3>
                            <p class="text-sm text-gray-500">Distribution of submitted applications.</p>
                        </div>
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                            {{ array_sum($statusCounts ?? []) }} total
                        </span>
                    </div>
                    <div class="mt-6 grow">
                        <canvas id="statusChart" class="w-full" height="240"></canvas>
                    </div>
                    <dl class="mt-6 grid gap-2 text-sm">
                        @forelse($statusCounts as $status => $count)
                            <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-3">
                                <dt class="font-medium text-gray-700">
                                    {{ \Illuminate\Support\Str::headline($status ?? 'Unknown') }}
                                </dt>
                                <dd class="text-gray-900 font-semibold">{{ $count }}</dd>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Submit your first application to see insights appear here.</p>
                        @endforelse
                    </dl>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Monthly submissions</h3>
                            <p class="text-sm text-gray-500">Last six months of activity.</p>
                        </div>
                        <span class="text-xs font-semibold text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                            {{ $currentMonthApplications }} this month
                        </span>
                    </div>
                    <div class="mt-6 grow">
                        <canvas id="trendChart" class="w-full" height="240"></canvas>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Recent applications</h3>
                    <p class="text-sm text-gray-500">Quick view of the last five submissions.</p>
                </div>
                @if ($recentUserApplications->isEmpty())
                    <div class="p-6 text-sm text-gray-500">No applications submitted yet.</div>
                @else
                    <ul class="divide-y divide-gray-100">
                        @foreach ($recentUserApplications as $application)
                            @php
                                $statusKey = strtolower($application->status ?? '');
                                $statusColorMap = [
                                    'approved' => 'text-emerald-700 bg-emerald-50',
                                    'accepted' => 'text-emerald-700 bg-emerald-50',
                                    'awarded' => 'text-emerald-700 bg-emerald-50',
                                    'rejected' => 'text-rose-700 bg-rose-50',
                                    'declined' => 'text-rose-700 bg-rose-50',
                                ];
                                $statusColorClass = $statusColorMap[$statusKey] ?? 'text-sky-700 bg-sky-50';
                            @endphp
                            <li class="p-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $application->scholarship->title ?? 'Scholarship removed' }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Submitted {{ optional($application->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center justify-center px-3 py-1 text-sm font-semibold rounded-full {{ $statusColorClass }}">
                                    {{ \Illuminate\Support\Str::headline($application->status ?? 'Pending') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </div>
    </div>

    <script>
        const dashboardChartColors = ['#0ea5e9', '#22c55e', '#f59e0b', '#a855f7', '#f43f5e', '#6b7280'];

        const setupCanvas = (canvas) => {
            const ratio = window.devicePixelRatio || 1;
            const width = canvas.clientWidth || canvas.width;
            const height = canvas.clientHeight || canvas.height || 240;
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            const ctx = canvas.getContext('2d');
            ctx.scale(ratio, ratio);
            return { ctx, width, height };
        };

        const drawDoughnutChart = (canvas, dataset) => {
            const { ctx, width, height } = setupCanvas(canvas);
            const radius = Math.min(width, height) / 2 - 8;
            const centerX = width / 2;
            const centerY = height / 2;
            const total = dataset.data.reduce((sum, value) => sum + value, 0);

            if (!total) {
                ctx.fillStyle = '#e5e7eb';
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
                ctx.fill();
            } else {
                let startAngle = -Math.PI / 2;
                dataset.data.forEach((value, index) => {
                    const sliceAngle = (value / total) * Math.PI * 2;
                    ctx.beginPath();
                    ctx.moveTo(centerX, centerY);
                    ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle);
                    ctx.closePath();
                    ctx.fillStyle = dashboardChartColors[index % dashboardChartColors.length];
                    ctx.fill();
                    startAngle += sliceAngle;
                });
            }

            ctx.globalCompositeOperation = 'destination-out';
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius * 0.55, 0, Math.PI * 2);
            ctx.fill();
            ctx.globalCompositeOperation = 'source-over';
        };

        const drawLineChart = (canvas, dataset) => {
            const { ctx, width, height } = setupCanvas(canvas);
            const padding = 24;
            const chartWidth = width - padding * 2;
            const chartHeight = height - padding * 2;

            const maxValue = Math.max(...dataset.data, 1);
            const points = dataset.data.length
                ? dataset.data.map((value, index) => {
                      const step = dataset.data.length > 1 ? index / (dataset.data.length - 1) : 0;
                      const x = padding + step * chartWidth;
                      const y = padding + (1 - value / maxValue) * chartHeight;
                      return { x, y };
                  })
                : [
                      { x: padding, y: padding + chartHeight },
                      { x: padding + chartWidth, y: padding + chartHeight },
                  ];

            ctx.fillStyle = 'rgba(15, 118, 110, 0.12)';
            ctx.beginPath();
            ctx.moveTo(points[0].x, height - padding);
            points.forEach((point) => ctx.lineTo(point.x, point.y));
            ctx.lineTo(points[points.length - 1].x, height - padding);
            ctx.closePath();
            ctx.fill();

            ctx.strokeStyle = '#0f766e';
            ctx.lineWidth = 2;
            ctx.beginPath();
            points.forEach((point, index) => {
                if (index === 0) {
                    ctx.moveTo(point.x, point.y);
                } else {
                    ctx.lineTo(point.x, point.y);
                }
            });
            ctx.stroke();

            ctx.fillStyle = '#0f766e';
            points.forEach((point) => {
                ctx.beginPath();
                ctx.arc(point.x, point.y, 3, 0, Math.PI * 2);
                ctx.fill();
            });
        };

        let userChartsInitialized = false;

        const initUserCharts = () => {
            if (userChartsInitialized) {
                return;
            }
            userChartsInitialized = true;

            const statusConfig = @json($statusChartData);
            const trendConfig = @json($trendChartData);

            const statusCanvas = document.getElementById('statusChart');
            if (statusCanvas) {
                drawDoughnutChart(statusCanvas, statusConfig);
            }

            const trendCanvas = document.getElementById('trendChart');
            if (trendCanvas) {
                drawLineChart(trendCanvas, trendConfig);
            }
        };

        if (document.readyState !== 'loading') {
            initUserCharts();
        } else {
            document.addEventListener('DOMContentLoaded', initUserCharts, { once: true });
        }

        window.addEventListener('load', initUserCharts, { once: true });
    </script>
</x-app-layout>
