<script setup lang="ts">
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Link, Head } from '@inertiajs/vue3';

// Using any type for Autoplay since we don't have type definitions
// @ts-expect-error Module has no type definitions
import Autoplay from 'embla-carousel-autoplay';

// Type definitions
interface Slide {
  id: number;
  src: string;
  alt: string;
  caption: string;
}

interface Event {
  id: number;
  title: string;
  date: string;
  location: string;
  description: string;
}

interface NewsItem {
  id: number;
  title: string;
  date: string;
  excerpt: string;
  image: string;
}

interface Testimonial {
  id: number;
  name: string;
  role: string;
  content: string;
  avatar: string;
}

const props = defineProps<{
  slides: Slide[];
  events: Event[];
  news: NewsItem[];
  testimonials: Testimonial[];
}>();
</script>

<template>
  <Head title="Home">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>
  <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
    <!-- Hero Section with Carousel -->
    <section class="relative h-[600px] overflow-hidden">
      <Carousel
        class="h-full"
        :plugins="[
          Autoplay({
            delay: 5000,
            stopOnInteraction: true,
            stopOnMouseEnter: true
          })
        ]"
      >
        <CarouselContent>
          <CarouselItem v-for="slide in props.slides" :key="slide.id" class="h-full">
            <div class="relative h-full">
              <img :src="`${slide.src}?w=1600&auto=format&fit=crop&q=80`" :alt="slide.alt" class="h-full w-full object-cover" >
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/30"/>
              <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                <h2 class="mb-2 text-3xl font-bold">{{ slide.caption }}</h2>
              </div>
            </div>
          </CarouselItem>
        </CarouselContent>
      </Carousel>

      <!-- Hero Content -->
      <div class="absolute inset-0 flex items-center justify-center text-center">
        <div class="max-w-3xl px-4">
          <Badge class="mb-4 px-3 py-1 text-sm" variant="outline" data-aos="fade-down" data-aos-delay="100">Education Management Platform</Badge>
          <h1 class="mb-4 text-4xl font-bold text-white md:text-5xl lg:text-6xl" data-aos="fade-down" data-aos-delay="200">
            School Management System
          </h1>
          <p class="mb-8 text-xl text-white md:text-2xl" data-aos="fade-up" data-aos-delay="300">
            A comprehensive platform for administrators, teachers, students, and parents
          </p>
          <div class="flex flex-col justify-center gap-4 sm:flex-row" data-aos="fade-up" data-aos-delay="400">
            <Link href="/register">
              <Button variant="default" size="lg" class="font-medium">Get Started</Button>
            </Link>
            <Link href="/login">
              <Button variant="outline" size="lg" class="border-white hover:bg-white/20 font-medium">Log In</Button>
            </Link>
          </div>
        </div>
      </div>
      </section>

      <!-- Stats Section -->
      <section class="bg-background py-10 relative -mt-16 z-10">
        <div class="container px-4 mx-auto">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 rounded-xl bg-card shadow-lg p-6">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
              <div class="text-3xl font-bold text-primary mb-1">1000+</div>
              <div class="text-sm text-muted-foreground">Students</div>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
              <div class="text-3xl font-bold text-primary mb-1">100+</div>
              <div class="text-sm text-muted-foreground">Teachers</div>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
              <div class="text-3xl font-bold text-primary mb-1">50+</div>
              <div class="text-sm text-muted-foreground">Courses</div>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
              <div class="text-3xl font-bold text-primary mb-1">95%</div>
              <div class="text-sm text-muted-foreground">Satisfaction</div>
            </div>
          </div>
        </div>
      </section>

      <!-- Quick Info Stats Section -->
      <section class="py-12 bg-muted">
        <div class="container px-4 mx-auto">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Upcoming Events -->
            <Card data-aos="fade-up" data-aos-delay="100" class="hover:shadow-md transition-all">
              <CardHeader>
                <CardTitle class="flex items-center">
                  <i class="lucide-calendar mr-2"></i>
                  Upcoming Events
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div class="space-y-3">
                  <div v-for="event in props.events" :key="event.id" class="border-b pb-3 last:border-b-0 last:pb-0">
                    <div class="text-sm text-muted-foreground">{{ new Date(event.date).toLocaleDateString() }}</div>
                    <div class="font-medium">{{ event.title }}</div>
                    <div class="text-sm text-muted-foreground">{{ event.description }}</div>
                  </div>
                </div>
              </CardContent>
              <CardFooter>
                <Link href="/events">
                  <Button variant="outline" class="w-full">View All Events</Button>
                </Link>
              </CardFooter>
            </Card>

            <!-- Latest News -->
            <Card data-aos="fade-up" data-aos-delay="200" class="hover:shadow-md transition-all">
              <CardHeader>
                <CardTitle class="flex items-center">
                  <i class="lucide-file-text mr-2"></i>
                  Latest News
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div class="space-y-3">
                  <div v-for="item in props.news" :key="item.id" class="border-b pb-3 last:border-b-0 last:pb-0">
                    <div class="text-sm text-muted-foreground">{{ new Date(item.date).toLocaleDateString() }}</div>
                    <div class="font-medium">{{ item.title }}</div>
                    <div class="text-sm text-muted-foreground">{{ item.excerpt }}</div>
                  </div>
                </div>
              </CardContent>
              <CardFooter>
                <Link href="/news">
                  <Button variant="outline" class="w-full">All News</Button>
                </Link>
              </CardFooter>
            </Card>

            <!-- Quick Links -->
            <Card data-aos="fade-up" data-aos-delay="300" class="hover:shadow-md transition-all">
              <CardHeader>
                <CardTitle class="flex items-center">
                  <i class="lucide-link mr-2"></i>
                  Quick Links
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div class="space-y-2">
                  <Link href="/admin-portal" class="block p-2 rounded-md hover:bg-accent transition-colors">
                    <div class="font-medium">Admin Portal</div>
                    <div class="text-sm text-muted-foreground">Manage entire school operations</div>
                  </Link>
                  <Link href="/student-portal" class="block p-2 rounded-md hover:bg-accent transition-colors">
                    <div class="font-medium">Student Portal</div>
                    <div class="text-sm text-muted-foreground">Access your courses and grades</div>
                  </Link>
                  <Link href="/teacher-portal" class="block p-2 rounded-md hover:bg-accent transition-colors">
                    <div class="font-medium">Teacher Portal</div>
                    <div class="text-sm text-muted-foreground">Manage classes and assignments</div>
                  </Link>
                  <Link href="/parent-portal" class="block p-2 rounded-md hover:bg-accent transition-colors">
                    <div class="font-medium">Parent Portal</div>
                    <div class="text-sm text-muted-foreground">Monitor your child's progress</div>
                  </Link>
                </div>
              </CardContent>
            </Card>
          </div>
        </div>
      </section>

      <!-- Featured Sections -->
      <section class="py-12 container px-4 mx-auto">
        <h2 class="text-3xl font-bold text-center mb-3">Discover Our Platform</h2>
        <p class="text-center text-muted-foreground mb-10 max-w-2xl mx-auto">Our comprehensive management system streamlines educational operations for all stakeholders.</p>

        <div class="grid md:grid-cols-2 gap-8 mb-12">
          <div data-aos="fade-right">
            <Link href="/features">
              <Card class="overflow-hidden h-full hover:shadow-lg transition-shadow">
                <div class="aspect-video">
                  <img src="https://images.unsplash.com/photo-1610563166150-b34df4f3bcd6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1076&q=80" alt="Features" class="w-full h-full object-cover" >
                </div>
                <CardContent class="p-6">
                  <h3 class="text-2xl font-bold mb-2">Powerful Features</h3>
                  <p class="text-muted-foreground">Explore the comprehensive tools and capabilities that make our platform the perfect solution for educational management.</p>
                </CardContent>
                <CardFooter>
                  <Button variant="link" class="px-0">
                    Learn More <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-1">
                      <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                  </Button>
                </CardFooter>
              </Card>
            </Link>
          </div>

          <div data-aos="fade-left">
            <Link href="/about">
              <Card class="overflow-hidden h-full hover:shadow-lg transition-shadow">
                <div class="aspect-video">
                  <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="About Us" class="w-full h-full object-cover" >
                </div>
                <CardContent class="p-6">
                  <h3 class="text-2xl font-bold mb-2">About Our Platform</h3>
                  <p class="text-muted-foreground">Learn about our mission, values, and approach to creating the best education management system.</p>
                </CardContent>
                <CardFooter>
                  <Button variant="link" class="px-0">
                    Learn More <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-1">
                      <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                  </Button>
                </CardFooter>
              </Card>
            </Link>
          </div>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
          <div data-aos="fade-up" data-aos-delay="100">
            <Link href="/admin">
              <Card class="overflow-hidden h-full hover:shadow-lg transition-shadow">
                <div class="aspect-video">
                  <img src="https://images.unsplash.com/photo-1552581234-26160f608093?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Administrators" class="w-full h-full object-cover" >
                </div>
                <CardContent class="p-6">
                  <h3 class="text-xl font-bold mb-2">For Administrators</h3>
                  <p class="text-muted-foreground">Efficiently manage school operations, staff, and academic programs.</p>
                </CardContent>
              </Card>
            </Link>
          </div>

          <div data-aos="fade-up" data-aos-delay="200">
            <Link href="/students">
              <Card class="overflow-hidden h-full hover:shadow-lg transition-shadow">
                <div class="aspect-video">
                  <img src="https://images.unsplash.com/photo-1427504494785-f06f85e504b3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Students" class="w-full h-full object-cover" >
                </div>
                <CardContent class="p-6">
                  <h3 class="text-xl font-bold mb-2">For Students</h3>
                  <p class="text-muted-foreground">Access your assignments, grades, and learning resources all in one place.</p>
                </CardContent>
              </Card>
            </Link>
          </div>

          <div data-aos="fade-up" data-aos-delay="300">
            <Link href="/teachers">
              <Card class="overflow-hidden h-full hover:shadow-lg transition-shadow">
                <div class="aspect-video">
                  <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Teachers" class="w-full h-full object-cover" >
                </div>
                <CardContent class="p-6">
                  <h3 class="text-xl font-bold mb-2">For Teachers</h3>
                  <p class="text-muted-foreground">Streamline your teaching process with powerful management tools.</p>
                </CardContent>
              </Card>
            </Link>
          </div>

          <div data-aos="fade-up" data-aos-delay="400">
            <Link href="/parents">
              <Card class="overflow-hidden h-full hover:shadow-lg transition-shadow">
                <div class="aspect-video">
                  <img src="https://images.unsplash.com/photo-1543269664-76bc3997d9ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Parents" class="w-full h-full object-cover" >
                </div>
                <CardContent class="p-6">
                  <h3 class="text-xl font-bold mb-2">For Parents</h3>
                  <p class="text-muted-foreground">Stay involved in your child's education with real-time insights.</p>
                </CardContent>
              </Card>
            </Link>
          </div>
        </div>
      </section>

      <!-- Features Section -->
      <section class="py-12 bg-gradient-to-r from-primary/10 to-secondary/10">
        <div class="container px-4 mx-auto">
          <h2 class="text-3xl font-bold text-center mb-3">Key Features</h2>
          <p class="text-center text-muted-foreground mb-10 max-w-2xl mx-auto">Everything you need for comprehensive educational management</p>

          <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-background p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="100">
              <div class="flex items-center mb-4">
                <div class="rounded-full bg-primary/10 p-3 mr-4">
                  <i class="lucide-users text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold">User Management</h3>
              </div>
              <p class="text-muted-foreground">Manage administrators, teachers, students, and parents with role-based access control.</p>
            </div>

            <div class="bg-background p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="200">
              <div class="flex items-center mb-4">
                <div class="rounded-full bg-primary/10 p-3 mr-4">
                  <i class="lucide-calendar text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold">Class Scheduling</h3>
              </div>
              <p class="text-muted-foreground">Create and manage class schedules, assign teachers, and handle room allocations.</p>
            </div>

            <div class="bg-background p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="300">
              <div class="flex items-center mb-4">
                <div class="rounded-full bg-primary/10 p-3 mr-4">
                  <i class="lucide-book-open text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold">Curriculum Planning</h3>
              </div>
              <p class="text-muted-foreground">Design and implement curriculum plans aligned with educational standards.</p>
            </div>

            <div class="bg-background p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="400">
              <div class="flex items-center mb-4">
                <div class="rounded-full bg-primary/10 p-3 mr-4">
                  <i class="lucide-pencil-ruler text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold">Assignments & Grading</h3>
              </div>
              <p class="text-muted-foreground">Create assignments, track submissions, and record grades with customizable grading systems.</p>
            </div>

            <div class="bg-background p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="500">
              <div class="flex items-center mb-4">
                <div class="rounded-full bg-primary/10 p-3 mr-4">
                  <i class="lucide-clipboard-list text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold">Attendance Tracking</h3>
              </div>
              <p class="text-muted-foreground">Monitor student attendance with detailed reports and automatic notifications.</p>
            </div>

            <div class="bg-background p-6 rounded-lg shadow-sm" data-aos="fade-up" data-aos-delay="600">
              <div class="flex items-center mb-4">
                <div class="rounded-full bg-primary/10 p-3 mr-4">
                  <i class="lucide-bar-chart text-primary text-xl"></i>
                </div>
                <h3 class="text-xl font-bold">Analytics & Reports</h3>
              </div>
              <p class="text-muted-foreground">Generate comprehensive reports on student performance, attendance, and other metrics.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Testimonials Section -->
      <section class="py-12 bg-muted">
        <div class="container px-4 mx-auto">
          <h2 class="text-3xl font-bold text-center mb-3">What Our Users Say</h2>
          <p class="text-center text-muted-foreground mb-10 max-w-2xl mx-auto">Hear from administrators, teachers, students, and parents who use our platform</p>

          <div class="grid md:grid-cols-3 gap-8">
            <div v-for="testimonial in props.testimonials" :key="testimonial.id" class="bg-background p-6 rounded-lg shadow-sm" data-aos="fade-up">
              <div class="flex items-center mb-4">
                <img :src="testimonial.avatar" :alt="testimonial.name" class="w-12 h-12 rounded-full mr-4 object-cover">
                <div>
                  <div class="font-bold">{{ testimonial.name }}</div>
                  <div class="text-sm text-muted-foreground">{{ testimonial.role }}</div>
                </div>
              </div>
              <p class="italic">"{{ testimonial.content }}"</p>
              <div class="flex items-center mt-3 text-yellow-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4" v-for="i in 5" :key="i">
                  <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Sign Up and Login Section -->
      <section class="py-12 bg-gradient-to-b from-background to-muted">
        <div class="container px-4 mx-auto">
          <h2 class="text-3xl font-bold text-center mb-10">Get Started Today</h2>

          <div class="max-w-md mx-auto bg-background p-8 rounded-lg shadow-sm text-center">
            <h3 class="text-2xl font-bold mb-4">Join Our Community</h3>
            <p class="text-muted-foreground mb-6">Create your account to access all features of our platform</p>

            <div class="space-y-4">
              <Link href="/register" class="w-full">
                <Button variant="default" class="w-full">Create Account</Button>
              </Link>

              <div class="flex items-center">
                <div class="h-px bg-border flex-1"></div>
                <span class="px-4 text-sm text-muted-foreground">OR</span>
                <div class="h-px bg-border flex-1"></div>
              </div>

              <Link href="/login" class="w-full">
                <Button variant="outline" class="w-full">Log In</Button>
              </Link>
            </div>
          </div>
        </div>
      </section>
    </div>
</template>
