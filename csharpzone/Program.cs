using System;
using System.Net.Http;
using System.Threading.Tasks;

class Program
{
    static async Task Main(string[] args)
    {
        // Replace these with your actual values
        string id = "your_device_id";
        double pressure = 0.8;
        bool active = true;
        string serverHost = "your_server_ip_or_domain";
        int serverPort = 80;

        using (HttpClient client = new HttpClient())
        {
            // Construct the URL
            string url = $"http://{serverHost}:{serverPort}/update.php";
            url += $"?ID={id}&Pressure={pressure}&Active={active}";

            try
            {
                HttpResponseMessage response = await client.GetAsync(url);

                if (response.IsSuccessStatusCode)
                {
                    Console.WriteLine("HTTP request successful");
                }
                else
                {
                    Console.WriteLine($"HTTP request failed with status code: {response.StatusCode}");
                }
            }
            catch (Exception ex)
            {
                Console.WriteLine($"An error occurred: {ex.Message}");
            }
        }
    }
}
