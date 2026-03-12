fetch("../api/dashboard_stats.php")
    .then(res => res.json())
    .then(data => {

        /* =========================
           KPI
        ========================= */
        const kpis = {
            totalTickets: data.totalTickets,
            openTickets: data.openTickets,
            progressTickets: data.progressTickets,
            resolvedTickets: data.resolvedTickets,
            highPriority: data.highPriority,
            mediumPriority: data.mediumPriority,
            lowPriority: data.lowPriority,
            totalRequests: data.totalRequests,
            approvedRequests: data.approvedRequests,
            rejectedRequests: data.rejectedRequests
        };

        Object.entries(kpis).forEach(([id, value]) => {
            document.getElementById(id).innerText = value;
        });

        /* =========================
           Chart.js defaults
        ========================= */
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#64748b';
        Chart.defaults.plugins.legend.labels.usePointStyle = true;

        /* =========================
           Função helper para criar charts
        ========================= */
        function createChart(canvasId, type, chartData, options) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            return new Chart(ctx, {
                type,
                data: chartData,
                options: { ...options, maintainAspectRatio: false }
            });
        }

        /* =========================
           Charts
        ========================= */

        const charts = [];

        // Tickets por status
        charts.push(createChart("ticketStatusChart", "doughnut", {
            labels: Object.keys(data.ticketStatus),
            datasets: [{
                data: Object.values(data.ticketStatus),
                backgroundColor: ['#0ea5e9', '#fbbf24', '#10b981'],
                borderWidth: 0
            }]
        }, {
            cutout: '70%',
            plugins: { legend: { position: 'left' } }
        }));

        // Tickets por prioridade
        charts.push(createChart("ticketPriorityChart", "bar", {
            labels: Object.keys(data.ticketPriority),
            datasets: [{
                data: Object.values(data.ticketPriority),
                backgroundColor: ['#fbbf24', '#f59e0b', '#ef4444'],
                borderRadius: 6
            }]
        }, {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { display: false } }, x: { grid: { display: false } } }
        }));

        // Requests por tipo
        charts.push(createChart("requestTypeChart", "pie", {
            labels: data.requestTypes,
            datasets: [{
                data: data.requestTypeTotals,
                backgroundColor: ['#1e3a8a', '#3b82f6', '#93c5fd'],
                borderWidth: 0
            }]
        }, { plugins: { legend: { position: 'left' } } }));

        // Requests por status
        charts.push(createChart("requestStatusChart", "doughnut", {
            labels: data.requestStatus,
            datasets: [{
                data: data.requestStatusTotals,
                backgroundColor: ['#0ea5e9', '#22c55e', '#ef4444'],
                borderWidth: 0
            }]
        }, { cutout: '70%', plugins: { legend: { position: 'left' } } }));

        // Tickets por mês
        charts.push(createChart("ticketMonthChart", "line", {
            labels: data.ticketMonths,
            datasets: [{
                label: "Tickets",
                data: data.ticketMonthTotals,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 8
            }]
        }, {
            plugins: { legend: { display: true, position: 'top', align: 'start', labels: { boxWidth: 10, padding: 20 } } },
            scales: { y: { display: false }, x: { grid: { display: false } } }
        }));

        // Requests por mês
        charts.push(createChart("requestMonthChart", "line", {
            labels: data.requestMonths,
            datasets: [{
                label: "Solicitações",
                data: data.requestMonthTotals,
                borderColor: '#334155',
                backgroundColor: 'rgba(51,65,85,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 8
            }]
        }, {
            plugins: { legend: { display: true, position: 'top', align: 'start', labels: { boxWidth: 10, padding: 20 } } },
            scales: { y: { display: false }, x: { grid: { display: false } } }
        }));

        // Comparação Tickets x Solicitações
        charts.push(createChart("comparisonChart", "bar", {
            labels: ["Tickets", "Solicitações"],
            datasets: [{
                label: "Total",
                data: data.comparison,
                backgroundColor: ['#6366f1', '#334155'],
                borderRadius: 8,
                barThickness: 40
            }]
        }, {
            plugins: { legend: { display: false } },
            scales: { x: { grid: { display: false } }, y: { grid: { display: false } } }
        }));

        /* =========================
           Redimensionamento responsivo
        ========================= */
        window.addEventListener('resize', () => {
            charts.forEach(chart => chart.resize());
        });
    });